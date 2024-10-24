<?php require 'partials/head.php'; ?>
<?php require 'partials/header.php'; ?>

<div class="form">
  <form id="register_form" enctype="multipart/form-data" method="POST">

    <?php if (isset($errors['message'])) : ?>
      <p class="success"><?= $errors['message'] ?></p>
    <?php endif ?>


    <input type="email" id="email" name="email" placeholder="UOB Email" value="<?= $_POST['email'] ?? '' ?>" aria-invalid="<?= isset($errors['email']) ? 'true' : 'none' ?>" required>

    
    <?php if (isset($errors['email'])) : ?>
      <p class="error"><?= $errors['email'] ?></p>
    <?php endif ?>


    <input type="password" id="password" name="password" value="<?= $_POST['password'] ?? '' ?>" aria-invalid="<?= isset($errors['password']) ? 'true' : 'none' ?>" placeholder="Password" required>

    <input type="password" id="password2" name="password2" value="<?= $_POST['password2'] ?? '' ?>" aria-invalid="<?= isset($errors['password']) ? 'true' : 'none' ?>" placeholder="Repeat Password" required>


    <?php if (isset($errors['password'])) : ?>
      <p class="error"><?= $errors['password'] ?></p>
    <?php endif ?>

    <button type="submit">Submit</button>
  </form>
</div>

<div>
  <span>Already have an account?</span>
  <a href="/login">Login</a>
</div>

<?php require 'partials/footer.php'; ?>