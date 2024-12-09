<?php
use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_room'])) {
    $roomID = $_POST['room_id'];
    $db->query('INSERT INTO rooms (name) VALUES (:name)', ['room_id' => $roomName]);
}


$rooms = $db->query('SELECT * FROM rooms')->fetchAll(PDO::FETCH_ASSOC);

view('admin_rooms.view.php', [
    'h1' => 'admin rooms',
    'p' => '',
   
]);

