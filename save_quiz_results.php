<?php
session_start();
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(['error' => 'Invalid request method']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$user_name = $data['user_name'];
$answers = $data['answers'];

if (!$user_id || !$user_name || !$answers) {
    echo json_encode(['error' => 'Invalid input data']);
    exit();
}

$climate = $answers['climate'];
$landscape = $answers['landscape'];
$activity = $answers['activity'];
$food = $answers['food'];
$budget = $answers['budget'];

// Delete existing quiz results for the user
$stmt = $con->prepare('DELETE FROM quiz_results WHERE user_id = ?');
$stmt->bind_param('i', $user_id);

if (!$stmt->execute()) {
    echo json_encode(['error' => 'Failed to delete existing quiz results']);
    exit();
}
$stmt->close();

// Fetch a random country
$query = "SELECT country_name FROM countries ORDER BY RAND() LIMIT 1";
$result = $con->query($query);
$country = $result->fetch_assoc()['country_name'];

// Save new quiz results
$stmt = $con->prepare('INSERT INTO quiz_results (user_id, user_name, climate, landscape, activity, food, budget, chosen_country) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->bind_param('isssssss', $user_id, $user_name, $climate, $landscape, $activity, $food, $budget, $country);

if (!$stmt->execute()) {
    echo json_encode(['error' => 'Failed to save quiz results']);
    exit();
}

echo json_encode(['country' => $country]);

$stmt->close();
$con->close();
?>
