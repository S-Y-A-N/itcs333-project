<?php

require_once 'admin_dashboard.php';

// Authorization check
authorize(isset($_SESSION['email']) && $_SESSION['admin'] === 1); 

// Load the view
view('admin_dashboard.view.php', [
    'h1' => 'Admin Dashboard',
    'p' => 'Welcome to the admin panel.'
]);