<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table = $_POST['table'];
    $id = $_POST['id'];

    // Ensure the table name is safe to use in the query
    $allowed_tables = ['quiz_results', 'bookings', 'forum_posts'];
    if (!in_array($table, $allowed_tables)) {
        http_response_code(400);
        echo 'Invalid table';
        exit();
    }

    // Prepare the DELETE query
    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        // Log error
        error_log('Prepare failed: ' . $con->error);
        http_response_code(500);
        echo 'Failed to prepare statement';
        exit();
    }
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        http_response_code(200);
        echo 'Row deleted successfully';
    } else {
        // Log error
        error_log('Execute failed: ' . $stmt->error);
        http_response_code(500);
        echo 'Failed to delete row';
    }

    $stmt->close();
    $con->close();
}
?>
