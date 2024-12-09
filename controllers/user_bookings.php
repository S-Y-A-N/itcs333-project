<?php
use Core\Database;

// Connect to the database
$config = require base_path('config.php'); // Load your database config
$db = new Database($config['database']); // Create a new Database object

$email = $_SESSION['email']; // Get the logged-in user's email from the session

// Validate that the user is logged in
if (!isset($email)) {
    // Redirect to login or show an error message
    header('Location: login.php');
    exit;
}

// Query to get upcoming bookings
$upcomingBookings = $db->query('SELECT * FROM bookings WHERE email = :email AND booking_time > NOW()', [
    'email' => $email
])->fetchAll(); // Fetch all upcoming bookings for the user

// Query to get past bookings
$pastBookings = $db->query('SELECT * FROM bookings WHERE email = :email AND booking_time < NOW()', [
    'email' => $email
])->fetchAll(); // Fetch all past bookings for the user

// Load the view to display the data
view('user_bookings.view.php', [
    'h1' => 'My Bookings',
    'p' => '',
    'upcoming' => $upcomingBookings,
    'past' => $pastBookings
]);

?>