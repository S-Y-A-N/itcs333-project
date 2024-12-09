<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/bc-nav.php'); ?>
<?php require base_path('views/partials/admin-header.php'); ?>

<form action="admin_schedules.php" method="post">
  <label for="room_id">Room:</label>
  <select id="room_id" name="room_id" required>
      <?php foreach ($rooms as $room): ?>
          <option value="<?php echo $room['room_id']; ?>"><?= $room['room_id'] . " {$room['room_name']}"; ?></option>
      <?php endforeach; ?>
  </select>
  <label for="start_time">Start Time:</label>
  <input type="datetime-local" id="start_time" name="start_time" required>
  <label for="end_time">End Time:</label>
  <input type="datetime-local">
</form>

<?php require base_path('views/partials/footer.php'); ?>