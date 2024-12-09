<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/bc-nav.php'); ?>
<?php require base_path('views/partials/admin-header.php'); ?>

  <!-- Success -->
  <?php if (isset($errors['message'])) : ?>
    <p class="success"><?= $errors['message'] ?></p>
  <?php endif ?>

  <!-- Conflict -->
  <?php if (isset($errors['conflict'])) : ?>
    <p class="error"><?= $errors['conflict'] ?></p>
  <?php endif ?>

<h2>Add New Schedule</h2>
<form method="post">

  <label for="room_id">Room</label>
  <select id="room_id" name="room_id" required>
      <?php foreach ($rooms as $room): ?>
          <option value="<?php echo $room['room_id']; ?>"><?= $room['room_id'] . " " . $room['room_name']; ?></option>
      <?php endforeach; ?>
  </select>

  <label for="start_time">Start Time</label>
  <input type="datetime-local" id="start_time" name="start_time" required>

  <label for="end_time">End Time</label>
  <input type="datetime-local" id="end_time" name="end_time" required>

  <?php if (isset($errors['time'])) : ?>
    <small class="error" id="time-helper"><?= $errors['time'] ?></small>
  <?php endif ?>

  <button type="submit" name="add_schedule">Add Schedule</button>
</form>

<h2>Current Bookings</h2>

<?php if (isset($errors['edit_message'])) : ?>
    <p class="success"><?= $errors['edit_message'] ?></p>
<?php endif ?>

<?php if (isset($errors['edit_error'])) : ?>
  <small class="error"><?= $errors['edit_error'] ?></small>
<?php endif ?>

<div class="overflow-auto">
<table>

  <thead>
    <tr>
      <th>Booking ID</th>
      <th>User Email</th>
      <th>Room ID</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Action</th>
    </tr>
  </thead>

  <?php foreach ($schedules as $schedule): ?>
  <tr>
      <form method="post">
          <td><input type="hidden" name="schedule_id" value="<?= $schedule['id'] ?>"> <?php echo $schedule['id'] ?> </td>
          <td><input type="hidden" name="email" value="<?= $schedule['room_id'] ?>"> <?php echo $schedule['email'] ?></td>
          <td>
            <select id="room_id" name="room_id" required>
              <?php foreach ($rooms as $room): ?>
                  <option <?php if($schedule['room_id'] == $room['room_id']) echo 'selected'; ?> value="<?= $room['room_id']; ?>"><?= $room['room_id'] . " {$room['room_name']}"; ?></option>
              <?php endforeach; ?>
            </select>
          </td>
          <td><input type="datetime-local" name="start_time" value="<?php echo $schedule['start_time']; ?>" required></td>
          <td><input type="datetime-local" name="end_time" value="<?php echo $schedule['end_time']; ?>" required></td>
          <td>
              <button type="submit" name="edit_schedule">Edit</button>
              <button class="del-btn" type="submit" name="delete_schedule">Delete</button>
          </td>
      </form>
  </tr>
  <?php endforeach; ?>
  
</table>
</div>

<?php require base_path('views/partials/footer.php'); ?>