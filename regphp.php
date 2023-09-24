<?php
function generateMemberID()
{
  $prefix = 'MEM'; // Prefix for the member ID
  $length = 6; // Length of the random portion of the ID
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Characters to choose from for the ID

  $randomID = '';

  for ($i = 0; $i < $length; $i++) {
    $randomIndex = rand(0, strlen($characters) - 1);
    $randomID .= $characters[$randomIndex];
  }

  $memberID = $prefix . $randomID;

  return $memberID;
}

$successMessage = ""; // Initialize the success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gym";

  try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Generate a member ID
    $memberID = generateMemberID();

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO member (member_id, member_name, member_phone, member_email, member_birthdate, member_startdate, member_membershiptype, member_weight, member_height, member_trainer, member_course) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the form data and member ID to the prepared statement
    $stmt->bindParam(1, $memberID);
    $stmt->bindParam(2, $_POST["name"]);
    $stmt->bindParam(3, $_POST["phone"]);
    $stmt->bindParam(4, $_POST["email"]);
    $stmt->bindParam(5, $_POST["birthdate"]);
    $stmt->bindParam(6, $_POST["startdate"]);
    $stmt->bindParam(7, $_POST["membershiptype"]);
    $stmt->bindParam(8, $_POST["weight"]);
    $stmt->bindParam(9, $_POST["height"]);
    $stmt->bindParam(10, $_POST["trainer"]);
    $stmt->bindParam(11, $_POST["course"]);

    // Execute the prepared statement
    $stmt->execute();

    // Set the success message
    $successMessage = "Member Registered Successfully";

    // Close the database connection
    $conn = null;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); // Output the error message for debugging purposes
  }
  
  // Redirect back to register.php
  header("Location: register.php?success=" . urlencode($successMessage));
  exit();
}

  ?>