<?php
use Core\Database;

try {
    $config = require base_path('config.php'); 
    $db = new Database($config['database']); 

    $comment = '';  // Initialize comment variable

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $comment = $_POST['comment'];

        // Correctly use $db instead of $pdo
        $stmt = $db->prepare("INSERT INTO comments (email, comment) VALUES (:email, :comment)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':comment', $comment);  // Correct binding here
        $stmt->execute();

        header("Location: feedback.view.php");
        exit();  // Ensure to exit after redirect to prevent further code execution
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Only call view if not redirecting
view('feedback.view.php', [
    'h1' => 'Feedback',
    'p' => '',
    'comment' => $comment
]);