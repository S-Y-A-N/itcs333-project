<?php

if(isset($_SESSION['email'])) {
  header('Location: /home');
  exit();
}

use Core\Validator;
use Core\Database;

// create database connection
$config = require base_path('config.php');
$db = new Database($config['database']);


// array for error messages
$errors = [];


// all the register logic and validation is here
if (Validator::post('register')) {

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

  // if no errors
  if (empty($errors)) {

    // query to insert user data into the db
    $db->query('INSERT INTO users(email, password, username) VALUES(:email, :password, :username)', [
      'email' => $_POST['email'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
      'username' => $_POST['email']
    ]);

    $errors['message'] = 'Regestration successful';

  }
}

// open register.view.php
view('register.view.php', [
  'h1' => 'Register',
  'p'=> 'To create a new account',
  'errors' => $errors
]);