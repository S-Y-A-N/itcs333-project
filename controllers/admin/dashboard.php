<?php

authorize($_SESSION['admin'] === 1);

use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']); 

// Query for room usage statistics
$rooms_usage = $db->query('SELECT room_id, COUNT(room_id) AS bookings FROM bookings GROUP BY room_id')->fetchAll();

$bookings_today = $db->query("SELECT COUNT(*) AS count FROM bookings WHERE start_time = NOW() ")->fetch()['count'];

$bookings_week = $db->query("SELECT COUNT(*) AS count FROM bookings WHERE start_time = WEEKOFYEAR(from_unixtime(unix_timestamp())) ")->fetch()['count'];


// Load the view
view('admin/dashboard.view.php', [
    'h1' => 'Dashboard',
    'p' => 'Adminstrator',
    'rooms_usage' => $rooms_usage,
    'bookings_today' 
]);
