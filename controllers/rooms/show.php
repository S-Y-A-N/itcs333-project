<?php

authorize(isset($_SESSION['email']));

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$room_id = (int) $_GET['id'];

// zainab
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
  $email = $_SESSION['email']; 
  $comment = $_POST['comment'];

  // Insert comment in database
  $stmt = $db->prepare('INSERT INTO comments (room_id, user_email, comment) VALUES (:room_id, :email, :comment)');
  $stmt->bindParam(':room_id', $room_id);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':comment', $comment);
  $stmt->execute();
}

// zainab 

$roomQuery = $db->query('SELECT * FROM rooms WHERE room_id = :id', [
  'id' => $room_id
]);

$room = $roomQuery->fetch();

$commentsQuery = $db->query('SELECT * FROM comments WHERE room_id = :room_id ORDER BY created_at DESC', [
  'room_id' => $room_id
]);
$comments = $commentsQuery->fetchAll();
//zainab

view("rooms/show.view.php", [
  'h1' => "S40-{$room_id}",
  'p' => "Room Details",
  'room' => $room,
  'comments' => $comments
]);