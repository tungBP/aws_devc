<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'db_connect.php';

// Fetch the selected country ID
if (isset($_POST['country_id'])) {
    $country_id = $_POST['country_id'];
    echo "Received country_id: " . htmlspecialchars($country_id) . "<br>";

    // Fetch destinations data
    $sql = "SELECT id, destination_name FROM destinations WHERE country_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $country_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div><input type="checkbox" name="destinations[]" value="' . htmlspecialchars($row['destination_name']) . '"> ' . htmlspecialchars($row['destination_name']) . '</div>';
        }
    } else {
        echo '<div>No destinations found for country_id: ' . htmlspecialchars($country_id) . '</div>';
    }

    // Close the database connection
    $stmt->close();
    $con->close();
} else {
    echo '<div>No country selected</div>';
}
?>
