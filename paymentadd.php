<?php
// Function to generate a random payment ID
function generatePaymentID()
{
  $prefix = 'PAY'; // Prefix for the payment ID
  $length = 6; // Length of the random portion of the ID
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Characters to choose from for the ID

  $randomID = '';

  for ($i = 0; $i < $length; $i++) {
    $randomIndex = rand(0, strlen($characters) - 1);
    $randomID .= $characters[$randomIndex];
  }

  $paymentID = $prefix . $randomID;

  return $paymentID;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

  $paymentID = generatePaymentID();

  // Prepare and bind the SQL statement
  $stmt = $conn->prepare("INSERT INTO payment (payment_id, member_id, member_name, member_amount, status, payment_date) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $paymentID, $member_id, $member_name, $member_amount, $status, $payment_date);

  // Get the form data
  $member_id = $_POST["member_id"];
  $member_amount = $_POST["member_amount"];
  $status = $_POST["status"];
  $payment_date = $_POST["payment_date"];

  // Fetch member name based on member ID
  $stmt_fetch = $conn->prepare("SELECT member_name FROM member WHERE member_id = ?");
  $stmt_fetch->bind_param("s", $member_id);
  $stmt_fetch->execute();
  $stmt_fetch->bind_result($member_name);
  $stmt_fetch->fetch();
  $stmt_fetch->close();

  $member_name = $member_name; // Assign the fetched member name to the variable

  if ($stmt->execute()) {
    // Payment record inserted successfully
    $successMessage = "Payment added successfully.";
  } else {
    // Failed to insert the payment record
    $errorMessage = "Error: " . $stmt->error;
  }

  // Close the statement and the database connection
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="Muscle1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="gym.css">
  <title>Payment</title>
  <style>
        .container-wrapper {
      margin-left: 300px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      height: 472px;
    }
     
    .form-wrapper {
      width: 500px;
      height: 320px;
      margin-left:20%;
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-direction: column;
    }

    .form-wrapper label {
      margin-bottom: 10px;
    }

    .form-wrapper input[type="text"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .form-row select {
  width: 54.5%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
    .form-wrapper input[type="number"] {
      width: 50%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    
    .form-wrapper input[type="date"] {
      width: 50%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .form-wrapper input[type="submit"] {
      width: 40%;
      padding: 10px;
      margin-top: 20px;
      background-color: blue;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-row {
      display: flex;
      justify-content: space-between;
    }

    .form-row label {
      flex-basis: 40%;
      text-align: right;
      margin-right: 20px;
    }

    .form-row input[type="text"] {
      flex-basis: 50%;
    }
  </style>
</head>
<body>
  <div class="main-container">
  <div class="logout">
  <button><a href="login.php"> Logout <i class="fas fa-sign-out-alt"></i> </a></button>
  </div>
  <div class="sidebar">
  <a href="dashboard.php">
    <img src="Muscle1.png" alt="logo" width="250px" height="200px">
  </a>
  <a class="foo" href="dashboard.php"><i class="fa fa-fw fa-home"></i> Home</a>
  <a class="foo" href="member.php"><i class="fa fa-fw fa-user"></i> Member</a>
  <a class="foo" href="payment.php"><i class="fas fa-money-bill"></i> Payment</a>
  <div class="dropdown">
      <a class="dropbtn" id="equip"><i class="fas fa-caret-down"></i> Equipment</a>
      <div class="dropdown-content">
        <a href="equip1.php"><i class="fas fa-dumbbell"></i> Dumbbell</a> 
        <a href="equip2.php"><i class="fas fa-running"></i> Treadmill</a>
      </div>
    </div>
</div>

<div class="container-wrapper" style="background-image: url(back.jpeg); background-repeat: no-repeat;background-size: cover;">
<div class="form-wrapper" style="text-align:center">
<h2>Add Payment</h2>
<?php
  // Check if success message exists
  if (isset($successMessage)) {
    echo '<p style="color: green;">' . $successMessage . '</p>';
  }
  // Check if error message exists
  if (isset($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
  }
  ?>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<div class="form-row">
<label for="member_id">Member ID:</label>
<select name="member_id" id="member_id" required>
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

  // Fetch member IDs and names from the member table
  $sql = "SELECT member_id, member_name FROM member";
  $result = $conn->query($sql);

  // Display member IDs and names as options
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $memberId = $row['member_id'];
      $memberName = $row['member_name'];
      echo "<option value='$memberId'>$memberId ($memberName)</option>";
    }
  }

  // Close the database connection
  $conn->close();
  ?>
  </select>
</div>
  <div class="form-row">
    <label for="member_amount">Amount:</label>
    <input type="number" name="member_amount" id="member_amount" required>
  </div>
  <div class="form-row">
    <label for="status">Status:</label>
    <select name="status" id="status" required>
      <option value="Paid">Paid</option>
      <option value="Unpaid">Unpaid</option>
    </select>
  </div>
  <div class="form-row">
    <label for="payment_date">Payment Date:</label>
    <input type="date" name="payment_date" id="payment_date" required>
  </div>

  <input type="submit" value="Add Payment">
</form>
</div>
  </div> 
    <div class="footer">
      <p>&copy; Copyright 2023 Muscle Maniac</p>
    </div>
  </div>
</body>
</html>