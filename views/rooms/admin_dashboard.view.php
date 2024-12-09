<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/protected-header.php'); ?>
<?php require base_path('views/partials/search-bar.php'); ?>

<main>
    <h1><?= htmlspecialchars($h1) ?></h1>
    <p><?= htmlspecialchars($p) ?></p>

    <section>
        <h2>Navigation</h2>
        <nav>
            <ul>
                <li><a href="/admin/rooms">Manage Rooms</a></li>
                <li><a href="/admin/schedules">Manage Schedules</a></li>
                <li><a href="/admin/users">Manage Users</a></li>
                <li><a href="/admin/settings">Settings</a></li>
            </ul>
        </nav>
    </section>
</main>

<?php require 'partials/footer.php'; ?>
<?php require base_path('views/partials/footer.php'); ?>