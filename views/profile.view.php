
<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/bc-nav.php'); ?>
<?php require base_path('views/partials/user-header.php'); ?>

<form method="post" enctype="multipart/form-data">

    <?php if (isset($errors['message'])) : ?>
        <p class="success"><?= $errors['message'] ?></p>
    <?php endif ?>

    <?php if (isset($errors['error'])) : ?>
        <p class="error"><?= $errors['error'] ?></p>
    <?php endif ?>

    <div class="profile-form-container flex-row wrap">
        <div>
            <!-- Display Name -->
            <label for="username">Display Name</label>
            <fieldset role="group" aria-describedby="name-helper">
                <input type="text" minlength="1" maxlength="20" id="username" name="username" value="<?= $_SESSION['username']; ?>" required>
                <button type="submit" name="update_name">Update Name</button>
            </fieldset>

            <?php if (isset($errors['username'])) : ?>
                <small class="error" id="name-helper"><?= $errors['username'] ?></small>
            <?php endif ?>

            <hr>
            
            <!-- Email -->
            <label for="email">Email</label>
            <fieldset role="group" aria-describedby="email-helper">
                <input type="email" maxlength="320" id="email" name="email" value="<?= $_SESSION['email']; ?>" required>
                <button type="submit" name="update_email">Update Email</button>
            </fieldset>

            <?php if (isset($errors['email'])) : ?>
                <small class="error" id="email-helper"><?= $errors['email'] ?></small>
            <?php endif ?>
        </div>

        <!-- Profile Pic -->
        <div>
            <label for="profile_picture">Profile Picture</label>
            <div class="flex-row pfp-container">
                <?php if (isset($user['profile_picture'])): ?>
                    <img id="pfp" class="pfp" src="<?= $profile_picture ?>" alt="Profile Picture">
                <?php endif; ?>

                <div class="flex-col pfp-controls">
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/png, image/jpeg" aria-describedby="file-helper">
                    <?php if (isset($errors['file'])) : ?>
                        <small class="error" id="file-helper"><?= $errors['file'] ?></small>
                    <?php endif ?>

                    <div class="flex-row pfp-btns">
                        <button class="del-btn" type="submit" name="delete_pfp">Delete</button>
                        <button type="submit" name="update_pfp">Update Profile Picture</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>

profile_picture.onchange = e => {
  const [file] = profile_picture.files;

  if (file) {
    pfp.src = URL.createObjectURL(file);
  }
}

</script>

<?php require base_path('views/partials/footer.php'); ?>
