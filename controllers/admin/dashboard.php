<?php

authorize(isset($_SESSION['email']) && $_SESSION['admin'] === 1);

use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']); 

// Fetch data for reports
$rooms_usage = $db->query('SELECT room_id, COUNT(room_id) AS bookings FROM bookings GROUP BY room_id')->fetchAll();

$bookings_today = $db->query("SELECT COUNT(*) AS count FROM bookings WHERE start_time = NOW() ")->fetch()['count'];

$bookings_week = $db->query("SELECT COUNT(*) AS count FROM bookings WHERE start_time = WEEKOFYEAR(from_unixtime(unix_timestamp())) ")->fetch()['count'];

$popular_rooms = $db->query('SELECT room_id, COUNT(*) as booking_count FROM bookings GROUP BY room_id ORDER BY booking_count DESC LIMIT 5')->fetchAll();

$total_bookings = $db->query('SELECT COUNT(*) as total_bookings FROM bookings')->fetchColumn();

// Load the view
view('admin/dashboard.view.php', [
    'h1' => 'Dashboard',
    'p' => 'Adminstrator',
    'rooms_usage' => $rooms_usage,
    'bookings_today' => $bookings_today,
    'bookings_week' => $bookings_week,
    'popular_rooms' => $popular_rooms,
    'total_bookings' => $total_bookings
]);
