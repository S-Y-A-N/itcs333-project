<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/header.php'); ?>

<div class="form">
  <form method="POST">
    <?php if (isset($errors['message'])) : ?>
      <p class="error"><?= $errors['message'] ?></p>
    <?php endif ?>
    <input type="email" id="email" name="email" placeholder="UOB Email" value="<?= $_POST['email'] ?? '' ?>" aria-invalid="<?= $invalid ?>" required>
    <input type="password" id="password" name="password" value="<?= $_POST['password'] ?? '' ?>" aria-invalid="<?= $invalid ?>" placeholder="Password" required>
    <button type="submit" name="login">Submit</button>
  </form>
</div>
<div>
  <span>Don't have an account?</span>
  <a href="/register">Register now</a>
</div>

<?php require base_path('views/partials/footer.php'); ?>