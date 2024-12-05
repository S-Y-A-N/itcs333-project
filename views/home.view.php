<?php require 'partials/head.php'; ?>
<?php require 'partials/user-header.php'; ?>
<?php require 'partials/search-bar.php'; ?>

<br>

<main>

  <section>
    <a href="/rooms">Browse all rooms</a>
  </section>

<br>

  <section class="flex-col">
    <h2>Departments</h2>

    <div class="dept-cards flex-row wrap">
      <a href="rooms/is">
        <article>
          <h3>Information Systems</h3>
          <img src="https://placehold.co/400x300/960000/white?text=IS" alt="">
        </article>
      </a>

      <a href="rooms/cs">
        <article >
          <h3>Computer Science</h3>
          <img src="https://placehold.co/400x300/ffbb00/292929?text=CS" alt="">
        </article>
      </a>


      <a href="rooms/ce">
        <article >
          <h3>Computer Engineering</h3>
          <img src="https://placehold.co/400x300/12206b/white?text=CE" alt="">
        </article>
      </a>

    </div>

  </section>
</main>

<?php require 'partials/footer.php'; ?>