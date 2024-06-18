<?php
session_start();
include 'db_connect.php';

if (mysqli_connect_error()) {
    exit('Error connecting to database: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username'], $_POST['password']) || empty($_POST['username']) || empty($_POST['password'])) {
        echo '<script>alert("Please fill in both the username and password fields."); window.history.back();</script>';
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($stmt = $con->prepare('SELECT id, username, user_code, password FROM users WHERE username = ?')) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $user_code, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['user_code'] = $user_code;
                echo '<script>alert("Login successful!"); window.location.href = "index.php";</script>';
                exit();
            } else {
                echo '<script>alert("Login failed. Invalid username or password."); window.history.back();</script>';
            }
        } else {
            echo '<script>alert("Login failed. Invalid username or password."); window.history.back();</script>';
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
      <title>Login</title>
      <link rel="icon" href="images/favicon.png" type="image/gif" />
      <link rel="stylesheet" href="css/login.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Login Form
         </div>
         <form action="login.php" method="post">
            <div class="field">
               <input type="text" id="username" name="username" required>
               <label>Username</label>
            </div>
            <div class="field">
               <input type="password" id="password" name="password" required>
               <label>Password</label>
            </div>
            
            <div class="field">
               <input type="submit" value="Login">
            </div>
            <div class="signup-link">
               Not a member? <a href="signup.php">Sign up now</a>
            </div>
         </form>
      </div>
   </body>
</html>
