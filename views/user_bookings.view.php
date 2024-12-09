<?php require 'partials/head.php'; ?>
<?php require 'partials/protected-header.php'; ?>
<?php require 'partials/search-bar.php'; ?>

<section>
    <a href="/home">Return to home page</a>
</section>

<h2>Upcoming Bookings</h2>
<ul>
    <?php if (!empty($upcoming)): ?>
        <?php foreach ($upcoming as $booking): ?>
            <li>
                Room ID: <?php echo htmlspecialchars($booking['room_id']); ?> at 
                <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($booking['booking_time']))); ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No upcoming bookings.</li>
    <?php endif; ?>
</ul>

<h2>Past Bookings</h2>
<ul>
    <?php if (!empty($past)): ?>
        <?php foreach ($past as $booking): ?>
            <li>
                Room ID: <?php echo htmlspecialchars($booking['room_id']); ?> at 
                <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($booking['booking_time']))); ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No past bookings.</li>
    <?php endif; ?>
</ul>

<?php require 'partials/footer.php'; ?>