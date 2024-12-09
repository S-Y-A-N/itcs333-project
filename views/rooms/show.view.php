<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/bc-nav.php'); ?>
<?php require base_path('views/partials/user-header.php'); ?>

<main>
  <section class="room">

  <!-- Success -->
  <?php if (isset($errors['message'])) : ?>
    <p class="success"><?= $errors['message'] ?></p>
  <?php endif ?>

  <!-- Conflict -->
  <?php if (isset($errors['conflict'])) : ?>
    <p class="error"><?= $errors['conflict'] ?></p>
  <?php endif ?>

  <form method="post">
    <div style="height: 400px;" id="panorama">
      <?php if ($room['img_width'] < 1500 || $room['img_width'] > 1650) : ?>
        <img class="room-img" src="<?= $room['img'] ?>" alt="Room Image">
      <?php endif; ?>
    </div>

    <div class="info">
      <table>
        <?php if (isset($room['room_name'])) : ?>
        <tr>
          <td>Room Name</td>
          <td><strong> <?= ucfirst($room['room_name']) ?> </strong></td>
        </tr>
        <?php endif; ?>
        <tr>
          <td>Room Type</td>
          <td> <?= ucfirst($room['type']) ?> </td>
        </tr>
        <tr>
          <td>Department</td>
          <td> <?= strtoupper($room['dept']) ?> </td>
        </tr>
        <tr>
          <td>Capacity</td>
          <td> <?= $room['capacity'] ?> People </td>
        </tr>
        <tr>
          <td>Equipment</td>
          <td> <?= preg_replace('/,/', ', ',$room['equip']) ?> </td>
        </tr>
        <tr>
          <td>Book Room</td>
          <td>
            <label for="start_time">Start Time</label>
            <input type="datetime-local" id="start_time" name="start_time" required>
            <label for="end_time">End Time</label>
            <input type="datetime-local" id="end_time" aria-describedby="time-helper" name="end_time" required>

            <?php if (isset($errors['time'])) : ?>
              <small class="error" id="time-helper"><?= $errors['time'] ?></small>
            <?php endif ?>
          </td>
        </tr>
      </table>
      <p style="color: DarkSlateBlue;">• Mximum time period is <strong>2 hours</strong></p>
      <p style="color: DarkSlateBlue;">• Allowed booking time is <strong>8 AM - 6 PM</strong></p>
    </div>
    <hr>
    <button type="submit" name="book_room">Book Room</button>
  </form>

  </section>
</main>

<?php if ($room['img_width'] > 1500 && $room['img_width'] < 1650) : ?>
<script>
pannellum.viewer('panorama', {
    "type": "equirectangular",
    "panorama": "<?= $room['img'] ?>",
    "preview": "<?= $room['img'] ?>",
    "autoRotate": -2,
    "vaov": 70,
    "vOffset": 0,
    "minPitch": 0,
    "maxPitch": 0,
    "pitch": 0,
    "showZoomCtrl": false,
    "keyboardZoom": false,
    "mouseZoom": false,
    "minHfov":100,
    "maxHfov":100,
});
</script>
<?php endif; ?>

<?php require base_path('views/partials/footer.php'); ?>