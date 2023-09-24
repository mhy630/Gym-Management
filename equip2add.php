<?php
// Function to generate a random equipment ID
function generateEquipID()
{
  $prefix = 'EQUIP'; // Prefix for the equipment ID
  $length = 6; // Length of the random portion of the ID
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Characters to choose from for the ID

  $randomID = '';

  for ($i = 0; $i < $length; $i++) {
    $randomIndex = rand(0, strlen($characters) - 1);
    $randomID .= $characters[$randomIndex];
  }

  $equipment_id = $prefix . $randomID;

  return $equipment_id;
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
  $maximum_speed = $_POST["maximum_speed"];
  $quantity = $_POST["quantity"];
  $purchase_date = $_POST["purchase_date"];
  $purchase_cost = $_POST["purchase_cost"];

  $equipment_id = generateEquipID();

  // Prepare and bind the SQL statement
  $stmt = $conn->prepare("INSERT INTO equipment2 (equipment_id, maximum_speed, quantity, purchase_date, purchase_cost) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $equipment_id, $maximum_speed, $quantity, $purchase_date, $purchase_cost);


  if ($stmt->execute()) {
    // Payment record inserted successfully
    $successMessage = "Equipment added successfully.";
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
  <title>Equipment</title>
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
      height: 420px;
      margin-left: 20%;
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-direction: column;
    }

    .form-wrapper label {
      margin-bottom: 10px;
      display: block;
      text-align: right;
      flex-basis: 40%;
      margin-right: 20px;
    }

    .form-wrapper input[type="text"],
    .form-wrapper input[type="number"],
    .form-wrapper input[type="date"] {
      width: 100%;
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
      align-items: center;
      margin-bottom: 10px;
    }

    .form-row input[type="text"],
    .form-row input[type="number"], 
    .form-row input[type="date"]{
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
        <h2>Add Equipment</h2>
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
            <label for="maximum_speed">Maximum Speed:</label>
            <input type="number" name="maximum_speed" id="maximum_speed" required>
          </div>
          <div class="form-row">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required>
          </div>
          <div class="form-row">
            <label for="purchase_date">Purchase Date:</label>
            <input type="date" name="purchase_date" id="purchase_date" required>
          </div>
          <div class="form-row">
            <label for="purchase_cost">Purchase Cost:</label>
            <input type="number" name="purchase_cost" id="purchase_cost" required>
          </div>
          <input type="submit" value="Add Equipment">
        </form>
      </div>
    </div>
    <div class="footer">
      <p>&copy; Copyright 2023 Muscle Maniac</p>
    </div>
  </div>
</body>
</html>