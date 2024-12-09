<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/bc-nav.php'); ?>
<?php require base_path('views/partials/user-header.php'); ?>
<?php require base_path('views/partials/search-bar.php'); ?>

<main>

  <section>
    <a href="/home">Return to home page</a>
  </section>

  <section class="grid">
    <?php foreach ($rooms as $room) : ?>
      <a href="/room?id=<?= $room['room_id'] ?>">
        <article>
            <h4> <?= ucfirst($room['type']) ?> </h4>
            <h5> <?= "S40-" . strtoupper($room['room_id']) ?> </h5>
        </article>
      </a>
    <?php endforeach; ?>

  </section>

</main>

<?php require base_path('views/partials/footer.php'); ?>