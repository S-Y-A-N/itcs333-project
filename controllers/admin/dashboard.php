<?php

authorize($_SESSION['admin'] === 1);

use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']); 

// Query for room usage statistics
$rooms_usage = $db->query('SELECT room_id, COUNT(room_id) AS bookings FROM bookings GROUP BY room_id')->fetchAll();

dump($rooms_usage);

$bookings_today = $db->query("SELECT COUNT(*) AS count FROM bookings WHERE start_time = NOW() ")->fetch()['count'];

dump($bookings_today);

$bookings_week = $db->query("SELECT COUNT(*) AS count FROM bookings WHERE start_time = WEEKOFYEAR(from_unixtime(unix_timestamp())) ")->fetch()['count'];

dump($bookings_today);

// // Fetch bookings and related room names
// try {
//     $bookings = $db->query('SELECT b.*, r.room_name FROM bookings b JOIN rooms r ON b.room_id = r.room_id')->fetchAll();
// } catch (Exception $e) {
//     die('Error fetching bookings: ' . htmlspecialchars($e->getMessage()));
// }


// // Fetch all rooms
// try {
//     $rooms = $db->query('SELECT * FROM rooms')->fetchAll(PDO::FETCH_ASSOC);
// } catch (Exception $e) {
  
//     die('Error fetching rooms: ' . htmlspecialchars($e->getMessage()));
// }

// Load the view
view('admin/dashboard.view.php', [
    'h1' => 'Dashboard',
    'p' => 'Adminstrator',
    'rooms_usage' => $rooms_usage,
    'bookings_today' 
]);
