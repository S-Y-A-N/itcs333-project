<?php require 'partials/head.php'; ?>
<?php require 'partials/protected-header.php'; ?>
<?php require 'partials/search-bar.php'; ?>

<section>
    <a href="/home">Return to home page</a>
</section>

    <title>Feedback Form</title>

    <h1>Submit Your Feedback</h1>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea>
        <br>
        <input type="submit" value="Submit">

</form>
<form action="/submit-comment" method="POST">
    <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
    <textarea name="comment" placeholder="Leave your feedback..." required></textarea>
    <button type="submit">Submit Comment</button>
</form>
<?php require 'partials/footer.php'; ?>