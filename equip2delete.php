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

// Get the equipment ID from the submitted form
$equipmentId = $_POST["equipment_id"];

// Delete the equipment from the database
$sql = "DELETE FROM equipment2 WHERE equipment_id = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $equipmentId);
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

// Redirect back to the equipment.php page
header("Location: equip2.php");
exit();
?>
