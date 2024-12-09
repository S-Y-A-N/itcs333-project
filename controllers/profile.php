<?php

// Check if the user is logged in and not admin
authorize(isset($_SESSION['email']) && $_SESSION['admin'] === 0);

use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$current_email = $_SESSION['email'];
$stmt = $db->query('SELECT * FROM users WHERE email = :current_email', [
    'current_email' => $current_email
]);
$user = $stmt->fetch();

$errors = [];

if (Validator::post('update_pfp')) {
    $profile_picture = $user['profile_picture'];
    $file = $_FILES['profile_picture']['tmp_name'];

    // Handle profile picture upload
    if ( !empty($file) ) {

        $mime = mime_content_type($file);

        // Check file size and type
        if (filesize($file) <= 5242880 && ($mime === 'image/png' || $mime === 'image/jpeg') ) {

            // remove old pfp from public and uploads folder
            if ($_SESSION['pfp'] !== 'default-pfp.png') {
                unlink(base_path("public/{$_SESSION['pfp']}"));
                unlink(base_path("uploads/{$_SESSION['pfp']}"));
            }

            // create file name: email.ext
            $ogfile = $_FILES['profile_picture']['name'];
            $ext = pathinfo($ogfile)['extension'];
            $profile_picture = "{$current_email}.{$ext}";

            // move file to uploads, copy to public
            move_uploaded_file($file, base_path("uploads/$profile_picture"));
            copy(base_path("uploads/$profile_picture"), base_path("public/$profile_picture"));

            // update record in db
            try {
                $stmt = $db->query("UPDATE users SET profile_picture = :profile_picture WHERE email = :current_email", [
                    'profile_picture' => $profile_picture,
                    'current_email' => $current_email
                ]);
            }
            
            catch(PDOException $e) {
                $errors['error'] = "Failed to update profile picture";
            }

            // Update session info
            $_SESSION['pfp'] = $profile_picture;

            $errors['message'] = "Profile picture updated successfully";

        }

        else {
            $errors['file'] = (filesize($file) > 5242880) ? "File size cannot exceed 5 MB" : "Failed to upload file";
        }
        
    }
}

else if (Validator::post('delete_pfp')) {
    if ($_SESSION['pfp'] !== 'default-pfp.png') {
        unlink(base_path("public/{$_SESSION['pfp']}"));
        unlink(base_path("uploads/{$_SESSION['pfp']}"));
        
        $profile_picture = 'default-pfp.png';
        copy(base_path("uploads/$profile_picture"), base_path("public/$profile_picture"));
    
        $stmt = $db->query("UPDATE users SET profile_picture = :profile_picture WHERE email = :current_email", [
            'profile_picture' => $profile_picture,
            'current_email' => $current_email
        ]);
    
        $_SESSION['pfp'] = $profile_picture;
    }
}

else if (Validator::post('update_name')) {
    $username = $_POST['username'];

    if (! Validator::username($username)) {
        $errors['username'] = "Only letters, numbers, spaces, dashes ( - ) and underscores ( _ ) are allowed";
    }

    else {

        $nameQuery = $db->query('SELECT username FROM users WHERE email = :email', [
            'email' => $_SESSION['email']
        ]);

        if ($nameQuery->rowCount() === 0) {
            try {
                $stmt = $db->query("UPDATE users SET username = :username WHERE email = :current_email", [
                    'username' => $username,
                    'current_email' => $current_email
                ]);
            }
            
            catch(PDOException $e) {
                $errors['error'] = "Failed to update name";
            }
    
            // Update session info
            $_SESSION['username'] = $username;
    
            $errors['message'] = "Name updated successfully";
        }
    }
}

else if (Validator::post('update_email')) {
    $email = $_POST['email'];

    if (! Validator::uob_email($email)) {
        $errors['email'] = "Only UOB emails are allowed";
    }

    else {

        $emailQuery = $db->query('SELECT email FROM users WHERE email = :email', [
            'email' => $email
        ]);

        // Check if email is used
        if ( $emailQuery->rowCount() > 0 && $email !== $current_email) {
            $errors['email'] = 'Email already registered to an account';
        }

        else {
            if ($email !== $current_email) {
                try {
                    $stmt = $db->query("UPDATE users SET email = :email WHERE email = :current_email", [
                        'email' => $email,
                        'current_email' => $current_email
                    ]);
                }
                
                catch(PDOException $e) {
                    $errors['error'] = "Failed to update email";
                }
    
                // Update session info
                $_SESSION['email'] = $email;
    
                $errors['message'] = "Email updated successfully";
            }
        }
    }
}

view('profile.view.php', [
    'h1' => 'Profile',
    'p' => 'Customize your profile here',
    'user' => $user,
    'errors' => $errors,
    'profile_picture' => $_SESSION['pfp']
]);