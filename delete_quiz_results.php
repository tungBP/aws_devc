<?php
session_start();
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(['error' => 'Invalid request method']);
    exit();
}

$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if (!$user_id) {
    echo json_encode(['error' => 'Invalid user ID']);
    exit();
}

// Delete existing quiz results for the user
$stmt = $con->prepare('DELETE FROM quiz_results WHERE user_id = ?');
$stmt->bind_param('i', $user_id);

if (!$stmt->execute()) {
    echo json_encode(['error' => 'Failed to delete quiz results']);
    exit();
}

echo json_encode(['success' => 'Quiz results deleted']);

$stmt->close();
$con->close();
?>
