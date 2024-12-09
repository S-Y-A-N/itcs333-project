<?php

// Get Main Pages
$router->get('/', 'controllers/index.php');
$router->get('/login', 'controllers/login.php');
$router->get('/register', 'controllers/register.php');
$router->get('/home', 'controllers/home.php');
$router->get('/logout', 'controllers/logout.php');

// Get Rooms Pages
$router->get('/rooms', 'controllers/rooms/index.php');
$router->get('/rooms/is', 'controllers/rooms/index.php');
$router->get('/rooms/cs', 'controllers/rooms/index.php');
$router->get('/rooms/ce', 'controllers/rooms/index.php');

// Show details for a single room
$router->get('/room', 'controllers/rooms/show.php');

// Profile page
$router->get('/profile', 'controllers/profile.php');

// User Bookings
$router->get('/bookings', 'controllers/user_bookings.php');

// reporting
$router->get('/reporting', 'controllers/reporting.php');

// statistics
$router->get('/statistics', 'controllers/statistics.php');

// feedback
$router->get('/feedback', 'controllers/feedback.php');

// admin
// Admin Routes
$router->get('/admin_dashboard', 'controllers/admin_dashboard.php');
$router->get('/admin_rooms', 'controllers/admin_rooms.php');
$router->get('/admin_schedules', 'controllers/admin_schedules.php');
// Post Requests
$router->post('/login', 'controllers/login.php');
$router->post('/register', 'controllers/register.php');
$router->post("/room", 'controllers/booking/book_room.php');