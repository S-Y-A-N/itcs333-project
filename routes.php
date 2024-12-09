<?php

// Main Pages
$router->get('/', 'controllers/index.php');
$router->get('/login', 'controllers/login.php');
$router->get('/register', 'controllers/register.php');
$router->get('/home', 'controllers/home.php');
$router->get('/logout', 'controllers/logout.php');

$router->post('/login', 'controllers/login.php');
$router->post('/register', 'controllers/register.php');

// Profile Page
$router->get('/profile', 'controllers/profile.php');
$router->post('/profile', 'controllers/profile.php');

// All Rooms Pages
$router->get('/rooms', 'controllers/rooms/index.php');
$router->get('/rooms/is', 'controllers/rooms/index.php');
$router->get('/rooms/cs', 'controllers/rooms/index.php');
$router->get('/rooms/ce', 'controllers/rooms/index.php');

// Show details for a single room
$router->get('/room', 'controllers/rooms/show.php');

// Room Booking
$router->get('/bookings', 'controllers/user_bookings.php');
$router->post('/room', 'controllers/booking/book_room.php');

// Admin Pages
$router->get('/admin-dashboard', 'controllers/admin/dashboard.php');
$router->get('/admin-rooms', 'controllers/admin/rooms.php');
$router->get('/admin-schedules', 'controllers/admin/schedules.php');

$router->post('/admin-rooms', 'controllers/admin/rooms.php');
$router->post('/admin-schedules', 'controllers/admin/schedules.php');