<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/admin-header.php'); ?>


<?php if (isset($errors['error'])) : ?>
  <p class="error"><?= $errors['error'] ?></p>
<?php endif ?>

<?php if (isset($errors['message'])) : ?>
  <p class="success"><?= $errors['message'] ?></p>
<?php endif ?>

<h2>Add Room</h2>

<form method="post">

  <label for="room_id">Room ID *</label>
  <input type="number" id="room_id" name="room_id" min="10" max="2999">

  <label for="room_name">Room Name</label>
  <input type="text" id="room_name" name="room_name" maxlength="200" aria-describedby="name-helper">

  <?php if (isset($errors['name'])) : ?>
    <small class="error" id="name-helper"><?= $errors['name'] ?></small>
  <?php endif ?>

  <label for="capacity">Capacity *</label>
  <input type="number" id="capacity" name="capacity" min="1" max="200" aria-describedby="cap-helper" required>

  <?php if (isset($errors['capacity'])) : ?>
    <small class="error" id="cap-helper"><?= $errors['capacity'] ?></small>
  <?php endif ?>

  <label for="capacity">Room Type *</label>
  <select name="room_type">
    <option>Classroom</option>
    <option>Lab</option>
  </select>

  <label for="equipment">Equipment</label>
  <select name="equipment[]" aria-label="Select available equipment..." multiple size="6">
    <option disabled>Select available equipment...</option>
    <?php foreach ($equipment as $e) : ?>
      <option><?= $e ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit" name="add_room">Add Room</button>
  <p>* required fields</p>
</form>

<h2>Existing Rooms</h2>
<table>
  <tr>
      <th>Room ID</th>
      <th>Room Name</th>
      <th>Capacity</th>
      <th>Equipment</th>
      <th>Action</th>
  </tr>
  <?php foreach ($rooms as $room): ?>
  <tr>
      <form method="post">
          <td><input type="hidden" name="room_id" value="<?= $room['room_id'] ?>"> <?= $room['room_id'] ?></td>
          <td><input type="text" name="room_name" maxlength="200" value="<?php echo $room['room_name']; ?>"></td>
          <td><input type="number" name="capacity" min="1" max="200" value="<?php echo $room['capacity']; ?>" required></td>
          <td>
            <select name="equipment[]" aria-label="Select available equipment..." multiple size="6">
              <option disabled>Select available equipment...</option>
              <?php foreach ($equipment as $e) : ?>
                <option><?= $e ?></option>
              <?php endforeach; ?>
            </select>
          </td>
          <td>
              <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
              <button type="submit" name="edit_room">Edit</button>
              <button class="del-btn" type="submit" name="delete_room">Delete</button>
          </td>
      </form>
  </tr>
  <?php endforeach; ?>
</table>

<?php require base_path('views/partials/footer.php'); ?>