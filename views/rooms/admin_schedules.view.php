<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/protected-header.php'); ?>
<?php require base_path('views/partials/search-bar.php'); ?>

<title>Manage Bookings</title>
</head>
<body>
    <h1>Manage Bookings</h1>
    <form action="admin_schedules.php" method="POST">
        <select name="room_id" required>
            <option value="">Select Room</option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?php echo $room['room_id']; ?>"><?php echo htmlspecialchars($room['room_id']); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="datetime-local" name="booking_time" required>
        <button type="submit" name="add_booking">Add Booking</button>
    </form>

    <h2>Existing Bookings</h2>
    <ul>
        <?php if (count($bookings) > 0): ?>
            <?php foreach ($bookings as $booking): ?>
                <li>
                    Room: <?php echo htmlspecialchars($booking['room_id']); ?>, 
                    Email: <?php echo htmlspecialchars($booking['email']); ?>, 
                    Booking Time: <?php echo htmlspecialchars($booking['booking_time']); ?>
                    <a href="admin_bookings.php?delete=<?php echo $booking['id']; ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No bookings found.</li>
        <?php endif; ?>
    </ul>
</body>

<?php require base_path('views/partials/footer.php'); ?>