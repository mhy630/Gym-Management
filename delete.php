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
$memberId = $_POST["member_id"];

// Delete the member from the database
$sql = "DELETE FROM member WHERE member_id = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $memberId);

if ($stmt->execute()) {
    // Member deleted successfully, set a session variable
    session_start();
    $_SESSION['member_deleted'] = true;
} else {
    // Error deleting member
    echo "Error deleting member: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();

// Redirect back to the member.php page
header("Location: member.php");
exit();
?>
