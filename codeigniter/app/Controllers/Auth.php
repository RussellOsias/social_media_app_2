<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    public function index()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = $this->validate([
                'email' => 'required|min_length[3]|max_length[30]|valid_email',
                'password' => 'required|min_length[5]|max_length[40]',
            ]);

            if (!$rules) {
                // Validation errors
                echo view('layouts/header');
                echo view('login', ['errors' => $this->validator->getErrors()]);
                echo view('layouts/footer');
            } else {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $model = new UsersModel();
                $user = $model->where('email', $email)->first(); // Fetch user by email

                if ($user && $model->verifyPassword($password, $user['password'])) {
                    $session = session();
                    $sessionData = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'isLoggedIn' => true
                    ];
                    $session->set($sessionData);

                    // Redirect to welcome page
                    return redirect()->to('/welcome');
                } else {
                    // Invalid credentials
                    $session = session();
                    $session->setFlashdata('error', 'Invalid email or password.');
                    return redirect()->to('/');
                }
            }
        } else {
            // Display login form
            $data = [];
            echo view('layouts/header', $data);
            echo view('login', $data);
            echo view('layouts/footer');
        }
    }

    public function register()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $userValid = $this->validate([
                'name' => 'required|min_length[3]|max_length[60]',
                'email' => 'required|min_length[3]|max_length[30]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[5]|max_length[40]',
                'confpassword' => 'matches[password]'
            ]);

            if (!$userValid) {
                echo view('layouts/header');
                echo view('register', ['errors' => $this->validator->getErrors()]);
                echo view('layouts/footer');
            } else {
                $model = new UsersModel();

                $data = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password') // Plain text password
                ];

                $insert = $model->save($data);

                if ($insert) {
                    $session = session();
                    $session->setFlashdata('success', 'Registration successful');
                    return redirect()->to('/login'); // Redirect to login page
                }
            }
        } else {
            echo view('layouts/header', $data);
            echo view('register', $data);
            echo view('layouts/footer');
        }
    }

    public function welcome()
    {
        $session = session();
        $userId = $session->get('id');

        if (!$userId) {
            return redirect()->to('/login'); // Redirect to login if not authenticated
        }

        $model = new UsersModel();
        $user = $model->find($userId);

        echo view('layouts/header');
        echo view('welcome', ['user' => $user]);
        echo view('layouts/footer');
    }

    public function update()
{
    $session = session();
    $userId = $this->request->getPost('id');

    // Load the model
    $model = new UsersModel();

    // Prepare data for update
    $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'birthday' => $this->request->getPost('birthday'),
        'age' => $this->request->getPost('age'),
        'gender' => $this->request->getPost('gender'),
        'address' => $this->request->getPost('address'),
        'occupation' => $this->request->getPost('occupation'),
        'nationality' => $this->request->getPost('nationality'),
    ];

    // Handle profile picture upload
    $profilePicture = $this->request->getFile('profile_cd');
    if ($profilePicture->isValid() && !$profilePicture->hasMoved()) {
        // Generate a new name for the file
        $newName = $profilePicture->getRandomName();

        // Move the file to the writable/uploads/profile_pictures directory
        $profilePicture->move(WRITEPATH . 'uploads/profile_pictures', $newName);

        // Update the profile picture field in the data array
        $data['profile_cd'] = $newName;
    } else {
        // Log an error message if the file upload fails
        log_message('error', 'Profile picture upload failed: ' . $profilePicture->getErrorString());
    }

    // Handle password update
    if ($this->request->getPost('password')) {
        $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    }

    // Update the user data in the database
    if ($model->update($userId, $data)) {
        $session->setFlashdata('success', 'Profile updated successfully');
    } else {
        $session->setFlashdata('error', 'Failed to update profile. Please try again.');
    }

    return redirect()->to('/welcome');
}


    public function change_password()
    {
        helper(['form']);
        $session = session();
        $userId = $session->get('id');

        if (!$userId) {
            return redirect()->to('/login'); // Redirect to login if not authenticated
        }

        if ($this->request->getMethod() == 'post') {
            $rules = $this->validate([
                'current_password' => 'required',
                'new_password' => 'required|min_length[5]|max_length[40]',
                'confirm_new_password' => 'matches[new_password]'
            ]);

            if (!$rules) {
                // Validation errors
                $model = new UsersModel();
                $user = $model->find($userId);
                $data = [
                    'user' => $user,
                    'errors' => $this->validator->getErrors()
                ];

                echo view('layouts/header');
                echo view('change_password', $data); // Ensure you have a view for change_password
                echo view('layouts/footer');
            } else {
                $model = new UsersModel();
                $user = $model->find($userId);

                if (password_verify($this->request->getPost('current_password'), $user['password'])) {
                    $data = [
                        'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT) // Hash new password
                    ];

                    $update = $model->update($userId, $data);

                    if ($update) {
                        $session->setFlashdata('success', 'Password updated successfully');
                    } else {
                        $session->setFlashdata('error', 'Failed to update password');
                    }
                } else {
                    $session->setFlashdata('error', 'Current password is incorrect');
                }

                return redirect()->to('/welcome'); // Redirect to welcome page
            }
        } else {
            $data = [];
            echo view('layouts/header');
            echo view('change_password', $data); // Ensure you have a view for change_password
            echo view('layouts/footer');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy(); // Destroy the session
        return redirect()->to('/login'); // Redirect to the login page
    }
}
