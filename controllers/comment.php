<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$room_id = $_POST['room_id'];
$user_email = $_SESSION['email'];
$comment = $_POST['comment'];

// Insert comment into the database
$db->query('INSERT INTO comments (room_id, user_email, comment) VALUES (:room_id, :user_email, :comment)', [
    'room_id' => $room_id,
    'user_email' => $user_email,
    'comment' => $comment
]);

header('Location: /room_details.php?id=' . $room_id); // Redirect back to the room details