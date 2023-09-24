<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the member ID from the submitted form
$memberId = $_POST["payment_id"];

// Delete the member from the database
$sql = "DELETE FROM payment WHERE payment_id = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $memberId);

if ($stmt->execute()) {
    // Member deleted successfully, set a session variable
    session_start();
    $_SESSION['payment_deleted'] = true;
} else {
    // Error deleting member
    echo "Error deleting Payment: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();

// Redirect back to the member.php page
header("Location: payment.php");
exit();
?>
