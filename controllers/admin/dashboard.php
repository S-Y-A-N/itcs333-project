<?php

authorize(isset($_SESSION['email']) && $_SESSION['admin'] === 1);

use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']); 

// Fetch data for reports
$rooms_usage = $db->query('SELECT room_id, COUNT(room_id) AS bookings FROM bookings GROUP BY room_id')->fetchAll();

$bookings_today = $db->query("SELECT bookings.room_id, DATE_FORMAT(bookings.start_time, '%H:%i') as s, DATE_FORMAT(bookings.end_time, '%H:%i') as e FROM bookings WHERE DATE(start_time) = CURDATE() ORDER BY start_time")->fetchAll();

$bookings_week = $db->query("SELECT bookings.room_id, DATE_FORMAT(bookings.start_time, '%a, %d %b %Y') as date, DATE_FORMAT(bookings.start_time, '%H:%i') as s, DATE_FORMAT(bookings.end_time, '%H:%i') as e FROM bookings WHERE WEEK(NOW()) BETWEEN WEEK(start_time) AND WEEK(end_time) ORDER BY start_time")->fetchAll();

$popular_rooms = $db->query('SELECT room_id, COUNT(*) as count FROM bookings GROUP BY room_id ORDER BY count DESC LIMIT 5')->fetchAll();

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
