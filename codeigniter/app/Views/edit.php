<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }
        .card {
            background-color: #333;
            border: 1px solid #f00;
        }
        .card-header {
            background-color: #f00;
            color: #fff;
            text-align: center;
        }
        .btn-primary {
            background-color: #f00;
            border: none;
        }
        .btn-primary:hover {
            background-color: #c00;
        }
        .form-control {
            background-color: #444;
            color: #fff;
            border: 1px solid #666;
        }
        .form-control::placeholder {
            color: #bbb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Information</h3>
                    </div>
                    <form method="post" action="<?= base_url('auth/update'); ?>">
                        <div class="card-body">
                            <div class="form-group mt-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?= esc($user['name']); ?>">
                            </div>
                            <div class="form-group mt-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= esc($user['email']); ?>">
                            </div>
                            <div class="form-group mt-2">
                                <label for="birthday">Birthday</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" value="<?= esc($user['birthday']); ?>">
                            </div>
                            <div class="form-group mt-2">
                                <label for="age">Age</label>
                                <input type="number" name="age" id="age" class="form-control" value="<?= esc($user['age']); ?>">
                            </div>
                            <div class="form-group mt-2">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                    <option value="Other" <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="<?= esc($user['address']); ?>">
                            </div>
                            <div class="form-group mt-2">
                                <label for="occupation">Occupation</label>
                                <input type="text" name="occupation" id="occupation
