<?php
use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']);

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}


$schedules = $db->query('SELECT s.*, r.room_name FROM schedules s JOIN rooms r ON s.room_id = r.room_id')->fetchAll(PDO::FETCH_ASSOC);


$rooms = $db->query('SELECT * FROM rooms')->fetchAll(PDO::FETCH_ASSOC);


view('admin_schedules.view.php', [
    'h1' => 'admin shcedules',
    'p' => '',
    'schedules' => $schedules,
    'rooms' => $rooms 
]);
