<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'email', 'password', 'profile_cd',
        'birthday', 'age', 'gender', 'address', 'occupation', 'nationality'
    ];

    protected $useTimestamps = true; // Automatically handle created_at and updated_at

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    /**
     * Hash the password before inserting into the database.
     *
     * @param array $data
     * @return array
     */
    protected function beforeInsert(array $data)
    {
        return $this->hashPassword($data);
    }

    /**
     * Hash the password before updating the database if it is provided.
     *
     * @param array $data
     * @return array
     */
    protected function beforeUpdate(array $data)
    {
        if (isset($data['data']['password'])) {
            return $this->hashPassword($data);
        }
        return $data;
    }

    /**
     * Hash the password.
     *
     * @param array $data
     * @return array
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }

    /**
     * Verify the provided password against the stored hashed password.
     *
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}
