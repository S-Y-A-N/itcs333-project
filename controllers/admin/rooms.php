<?php

authorize(isset($_SESSION['email']) && $_SESSION['admin'] === 1);

use Core\Validator;
use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']); 

$errors = [];

if (Validator::post('add_room')) {
  $room_id = $_POST['room_id'];
  $room_name = $_POST['room_name'];
  $room_type = $_POST['room_type'];
  $capacity = $_POST['capacity'];
  $equipment = '';
  if (isset($_POST['equipment'])) $equipment = implode(',', $_POST['equipment']);

  $roomQuery = $db->query("SELECT * FROM rooms WHERE room_id = :room_id", [
    'room_id' => $room_id
  ]);

  if ($roomQuery->rowCount() > 0) {
    $errors['error'] = 'Room already exists';
  }

  else if (! Validator::string_length($room_name, 0, 200)) {
    $errors['name'] = 'Room name length must not exceed 200 characters';
  }

  else if ($capacity > 200 || $capacity <= 0) {
    $errors['capacity'] = 'Capacity must be between 1 and 200';
  }

  else {
    $room_digit = (int) $room_id % 100;

    if ($room_digit < 40) {
      $dept = 'is';
    } else if ($room_digit < 70) {
      $dept = 'cs';
    } else {
      $dept = 'ce';
    }

    try {
      $stmt = $db->query("INSERT INTO rooms (room_id, room_name, `type`, equip, dept, capacity) VALUES (:room_id, :room_name, :type, :equip, :dept, :capacity)", [
        'room_id' => $room_id,
        'room_name' => $room_name,
        'type' => $room_type,
        'equip' => $equipment,
        'dept' => $dept,
        'capacity' => $capacity
      ]);

      $errors['message'] = "Room s40-$room_id added successfully";

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}

if (Validator::post('edit_room')) {
  $room_id = $_POST['room_id'];
  $room_name = $_POST['room_name'];
  $capacity = $_POST['capacity'];
  $equipment = '';
  if (isset($_POST['equipment'])) $equipment = implode(',', $_POST['equipment']);

  if (! Validator::string_length($room_name, 0, 200)) {
    $errors['name'] = 'Room name length must not exceed 200 characters';
  }

  else if ($capacity > 200 || $capacity <= 0) {
    $errors['capacity'] = 'Capacity must be between 1 and 200';
  }

  else {
    try {
      $stmt = $db->query("UPDATE rooms SET room_name = :room_name, capacity = :capacity, equip = :equip WHERE room_id = :room_id", [
        'room_id' => $room_id,
        'room_name' => $room_name,
        'capacity' => $capacity,
        'equip' => $equipment,
      ]);

      $errors['message'] = "Room s40-$room_id added successfully";

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }


}

if (Validator::post('delete_room')) {
  $room_id = $_POST['room_id'];

  $stmt = $db->query("DELETE FROM rooms WHERE room_id = :room_id", [
    'room_id' => $room_id
  ]);
}

$rooms = $db->query("SELECT * FROM rooms")->fetchAll();

$equipment = $db->query("DESCRIBE rooms equip;")->fetch()["Type"];
$equipment = preg_replace("/(set|\(|\)|')/", "", $equipment);
$equipment = explode(',', $equipment);


view('admin/rooms.view.php', [
  'h1' => 'Manage Rooms',
  'p' => 'Add, edit, and delete rooms in s40',
  'rooms' => $rooms,
  'equipment' => $equipment,
  'errors' => $errors
]);

