<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/protected-header.php'); ?>
<?php require base_path('views/partials/search-bar.php'); ?>

<title>Manage Schedules</title>
</head>
<body>
    <h1>Manage Schedules</h1>
    <form action="admin_schedules.php" method="POST">
        <select name="room_id" required>
            <option value="">Select Room</option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?php echo $room['room_id']; ?>"><?php echo htmlspecialchars($room['room_name']); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="schedule_date" required>
        <button type="submit" name="add_schedule">Add Schedule</button>
    </form>

    <h2>Existing Schedules</h2>
    <ul>
        <?php if (count($schedules) > 0): ?>
            <?php foreach ($schedules as $schedule): ?>
                <li>
                    Room: <?php echo htmlspecialchars($schedule['room_id']); ?> on <?php echo htmlspecialchars($schedule['date']); ?>
                    <a href="admin_schedules.php?delete=<?php echo $schedule['id']; ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No schedules found.</li>
        <?php endif; ?>
    </ul>
</body>

<?php require base_path('views/partials/footer.php'); ?>