<?php
// Include the database connection file
include 'db_connect.php';

// Fetch countries data
$sql = "SELECT id, country_name FROM countries";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['country_name'] . '</option>';
    }
} else {
    echo '<option>No countries found</option>';
}

// Close the database connection
$con->close();
?>
