<?php

use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']);

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    header("Location: admin_login.php");
    exit();
}

// Fetch bookings and related room names
try {
    $bookings = $db->query('SELECT b.*, r.room_name FROM bookings b JOIN rooms r ON b.room_id = r.room_id')->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Handle the error (log it, show a friendly message, etc.)
    die('Error fetching bookings: ' . htmlspecialchars($e->getMessage()));
}

// Fetch all rooms
try {
    $rooms = $db->query('SELECT * FROM rooms')->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Handle the error (log it, show a friendly message, etc.)
    die('Error fetching rooms: ' . htmlspecialchars($e->getMessage()));
}

// Load the view
view('admin_schedules.view.php', [
    'h1' => 'Admin Bookings',
    'p' => '',
    'bookings' => $bookings,
    'rooms' => $rooms 
]);
