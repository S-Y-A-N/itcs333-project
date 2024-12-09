<?php

authorize(isset($_SESSION['email']));

use Core\Database;

// create database connection
$config = require base_path('config.php');
$db = new Database($config['database']);

// get department from url
$dept = basename($uri);

$h1 = 'Rooms';
$p = 'Browse all rooms in IT college (S40)';
$rooms = [];

if ($dept === 'rooms') {

  // get all rooms from db
  $roomsQuery = $db->query('SELECT * FROM rooms');
  $rooms = $roomsQuery->fetchAll();
} else {

  // get rooms for a specific department
  if ($dept === 'is' || $dept === 'cs' || $dept === 'ce') {
    $roomsQuery = $db->query('SELECT * FROM rooms WHERE dept = :dept', [
      'dept' => $dept
    ]);

    $rooms = $roomsQuery->fetchAll();
    $dept = strtoupper($dept);
    $h1 =  "$dept Rooms";
    $p = "Browse all rooms in $dept department";
  }

}

view('rooms/index.view.php', [
  'h1' => $h1,
  'p' => $p,
  'rooms' => $rooms,
  'dept' => $dept
]);