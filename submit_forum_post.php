<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit();
}

include 'db_connect.php';

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $message = $_POST['message'];
    $user_id = $_SESSION['id'];
    $defaultImagePath = 'uploads/default.jpeg';
    $imagePath = $defaultImagePath; // Default to the default image path

    // Handle image upload if a file was submitted
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . basename($image['name']);

        // Check if the uploads directory exists and is writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!is_writable($uploadDir)) {
            $_SESSION['error'] = "Upload directory is not writable.";
            header('Location: forum.php');
            exit();
        }

        // Move the uploaded file to the specified directory
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            $_SESSION['error'] = "Failed to move uploaded file.";
            $imagePath = $defaultImagePath;
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO forum_posts (user_id, name, message, image) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("isss", $user_id, $name, $message, $imagePath);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Post submitted successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}

// Redirect back to the forum page
header('Location: forum.php');
exit();
?>
