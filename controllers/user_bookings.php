<?php

// Check if the user is logged in and not admin
authorize(isset($_SESSION['email']) && $_SESSION['admin'] === 0);

use Core\Database;

// Connect to the database
$config = require base_path('config.php'); // Load your database config
$db = new Database($config['database']); // Create a new Database object

$email = $_SESSION['email']; // Get the logged-in user's Email from the session

// Query to get upcoming bookings
$upcomingBookings = $db->query('SELECT * FROM bookings WHERE email = :email AND start_time > NOW()', [
    'email' => $email
])->fetchAll(); // Fetch all upcoming bookings for the user

// Query to get past bookings
$pastBookings = $db->query('SELECT * FROM bookings WHERE email = :email AND end_time < NOW()', [
    'email' => $email
])->fetchAll(); // Fetch all past bookings for the user

// Load the view to display the data
view('user_bookings.view.php', [
    'h1' => 'My Bookings',
    'p' => 'View upcoming and past bookings',
    'upcoming' => $upcomingBookings,
    'past' => $pastBookings
]);