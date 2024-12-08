<?php require base_path('views/partials/head.php'); ?>

<?php require base_path('views/partials/breadcrumb-nav.php'); ?>

<?php require base_path('views/partials/protected-header.php'); ?>

<main>

<section class="room">

<form method="post">

<div style="height: 400px;" id="panorama"></div>
<div class="info">
  <table>
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
      <td> <?= '...' ?> </td>
    </tr>
    <tr>
      <td>Book Room</td>
      <td>
        <input type="datetime-local" id="booking_time" name="booking_time" required>
      </td>
    </tr>
  </table>
</div>

<button type="submit">Book Room</button>
</form>

<h3>Leave a Comment</h3>

<form method="post">

<textarea name="comment" placeholder="Leave your comment..." required></textarea>

<button type="submit">Submit Comment</button>

</form>
<!-- Display Comments -->
<h3>Comments</h3>
<?php if ($comments): ?>
  <ul>
    <?php foreach ($comments as $comment): ?>
      <li>
        <strong><?= htmlspecialchars($comment['user_email']) ?>:</strong>
        <?= htmlspecialchars($comment['comment']) ?>
        <em> on <?= htmlspecialchars($comment['created_at']) ?></em>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>No comments yet.</p>
<?php endif; ?>
</section>

</main>

<script>

pannellum.viewer('panorama', {

"type": "equirectangular",

"panorama": "classroom-360.jpg",

"preview": "classroom-360.jpg",

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

<?php require base_path('views/partials/footer.php'); ?>