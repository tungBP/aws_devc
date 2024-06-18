<?php
session_start();
include 'db_connect.php';

if (mysqli_connect_error()) {
    exit('Error connecting to database: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username'], $_POST['user_code'], $_POST['password'], $_POST['email']) || empty($_POST['username']) || empty($_POST['user_code']) || empty($_POST['password']) || empty($_POST['email'])) {
        echo '<script>alert("Please fill in all the fields."); window.history.back();</script>';
        exit();
    }

    $username = $_POST['username'];
    $user_code = $_POST['user_code'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Check if username or user_code already exists
    if ($stmt = $con->prepare('SELECT id FROM users WHERE username = ? OR user_code = ?')) {
        $stmt->bind_param('ss', $username, $user_code);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo '<script>alert("Username or User Code already exists"); window.history.back();</script>';
        } else {
            // Insert new user
            if ($stmt = $con->prepare('INSERT INTO users (user_code, username, password, email) VALUES (?, ?, ?, ?)')) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the password
                $stmt->bind_param('ssss', $user_code, $username, $hashed_password, $email);
                $stmt->execute();
                echo '<script>alert("Registration successful"); window.location.href = "login.php";</script>';
                exit();
            } else {
                echo '<script>alert("Error: Could not prepare statement."); window.history.back();</script>';
            }
        }
        $stmt->close();
    } else {
        echo '<script>alert("Error: Could not prepare statement."); window.history.back();</script>';
    }
    $con->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>SignUp</title>
      <link rel="icon" href="images/favicon.png" type="image/gif" />
      <link rel="stylesheet" href="css/signup.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Sign Up Form
         </div>
         <form action="signup.php" method="post">
            <div class="field">
               <input type="text" id="user_code" name="user_code" required>
               <label for="username">Your name</label>
            </div>
            <div class="field">
               <input type="text" id="username" name="username" required>
               <label for="user_code">Username</label>
            </div>
            <div class="field">
               <input type="password" id="password" name="password" required>
               <label for="password">Password</label>
            </div>
            <div class="field">
               <input type="email" id="email" name="email" required>
               <label for="email">Email</label>
            </div>
            
            <div class="field">
               <input type="submit" value="SignUp">
            </div>
            <div class="signup-link">
               Currently a member? <a href="login.php">Login now</a>
            </div>
         </form>
      </div>
   </body>
</html>
