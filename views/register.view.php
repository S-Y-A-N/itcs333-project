<?php require 'partials/head.php'; ?>
<?php require 'partials/header.php'; ?>

<div class="form">
  <form id="register_form" enctype="multipart/form-data" method="POST">

    <?php if (isset($errors['message'])) : ?>
      <p class="success"><?= $errors['message'] ?></p>
    <?php endif ?>


    <input type="email" id="email" name="email" placeholder="UOB Email" aria-describedby="email-helper" value="<?= $_POST['email'] ?? '' ?>" aria-invalid="<?= isset($errors['email']) ? 'true' : 'none' ?>" required>

    
    <?php if (isset($errors['email'])) : ?>
      <small class="error" id="email-helper"><?= $errors['email'] ?></small>
    <?php endif ?>


    <input type="password" id="password" name="password" aria-describedby="password-helper" value="<?= $_POST['password'] ?? '' ?>" aria-invalid="<?= isset($errors['password']) ? 'true' : 'none' ?>" placeholder="Password" required>

    <input type="password" id="password2" name="password2" aria-describedby="password-helper" value="<?= $_POST['password2'] ?? '' ?>" aria-invalid="<?= isset($errors['password']) ? 'true' : 'none' ?>" placeholder="Confirm Password" required>


    <?php if (isset($errors['password'])) : ?>
      <small class="error" id="password-helper"><?= $errors['password'] ?></small>
    <?php endif ?>

    <!-- Admin Registration Checkbox -->
    <label for="admin">Register as Admin</label>
    <input type="checkbox" id="admin" name="admin" value="1">

    <button type="submit">Submit</button>
  </form>
</div>

<div>
  <span>Already have an account?</span>
  <a href="/login">Login</a>
</div>

<?php require 'partials/footer.php'; ?>