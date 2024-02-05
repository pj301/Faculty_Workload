<?php
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $prog_code = $_POST['prog_code'];
    // Retrieve other fields as needed

    // Perform the database insertion
    $insert_query = "INSERT INTO program (prog_code, col_ID) VALUES ('$prog_code', '$collegeID')"; // Add other fields as needed
    $result = $conn->query($insert_query);

    // Check if the insertion was successful
    if ($result) {
        echo 1; // Success
    } else {
        echo 0; // Failure
    }
}
?>
