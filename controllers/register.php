<?php

use Core\Database;
use Core\Validator;

echo 'POST';
dump($_POST);

// create database connection
$config = require base_path('config.php');
$db = new Database($config['database']);


// array for error messages
$errors = [];


// TODO - here we add all the register logic and validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // query to find email in db
  $emailQuery = $db->query('SELECT email FROM users WHERE email = :email', [
    'email' => $_POST['email']
  ]);

  // if email exists in db
  if ($emailQuery->rowCount() > 0) {

    $errors['message'] = 'You already have an account, please login instead';

  } else {

    // if not a uob email
    if (! Validator::uob_email($_POST['email'])) {
      $errors['email'] = 'Please use your university email';
    }

    // if weak password
    else if (! Validator::password_strong($_POST['password'])) {
      $errors['password'] = 'Your password must be at least 8 characters long, and include at least one uppercase letter, one lowercase letter, one number, and one special character';
    }

    // if passwords do not match
    else if (! Validator::password_match($_POST['password'], $_POST['password2'])) {
      $errors['password'] = 'Your passwords do not match';
    }

  }

  // If no errors
  if (empty($errors)) {
    // Determine if the user is registering as an admin
    $isAdmin = isset($_POST['admin']) ? 1 : 0; // Default to 0 if not checked

    // Query to insert user data into the db, including admin status
    $db->query('INSERT INTO users(email, password, admin) VALUES(:email, :password, :admin)', [
      'email' => $_POST['email'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
      'admin' => $isAdmin
    ]);

    $errors['message'] = 'Registration successful';
  }
}

// open register.view.php
view('register.view.php', [
  'h1' => 'Register',
  'p'=> 'To create a new account',
  'errors' => $errors
]);