<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/protected-header.php'); ?>
<?php require base_path('views/partials/search-bar.php'); ?>

    <title>Manage Rooms</title>
</head>
<body>
    <h1>Manage Rooms</h1>
    <form action="admin_rooms.php" method="POST">
        <input type="text" name="room_name" placeholder="Room Name" required>
        <button type="submit" name="add_room">Add Room</button>
    </form>

    <h2>Existing Rooms</h2>
    <ul>
        <?php foreach ($rooms as $room): ?>
            <li>
                <?php echo htmlspecialchars($room['name']); ?>
                <a href="admin_rooms.php?delete=<?php echo $room['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
<?php require base_path('views/partials/footer.php'); ?>