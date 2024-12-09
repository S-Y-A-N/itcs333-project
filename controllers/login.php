
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

// only used inside view.php for aria-invalid attribute
$invalid = true;

if (Validator::post('login')) {

  // query to find email in db
  $emailQuery = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $_POST['email']
  ]);

  // if email does not exist in db
  if ($emailQuery->rowCount() === 0) {

    $errors['message'] = 'You have entered an invalid email or password';

  } else {

    // get user data from db
    $user = $emailQuery->fetch();
    $password = $user['password'];

    // verify the entered password with hashed password
    if (password_verify($_POST['password'], $password)) {

      // successful login, start session
      $_SESSION['email'] = $_POST['email'];

      $_SESSION['username'] = $user['username'];

      // specify user type (admin or not) in session
      $_SESSION['admin'] = $user['admin'];

      // copy profile pic to public folder
      $_SESSION['pfp'] = $user['profile_picture'];
      copy(base_path("uploads/{$_SESSION['pfp']}"), base_path("public/{$_SESSION['pfp']}"));
      header('Location: /home');
      exit();

    } else {
      $errors['message'] = 'You have entered an invalid email or password';
    }
    
  }
}


// open index.view.php
view('login.view.php', [
  'h1' => 'Login',
  'p'=> 'If you are already registered',
  'errors' => $errors,
  'invalid' => $invalid
]);