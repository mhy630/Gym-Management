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
    <h2>Edit Payment</h2>
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

    if (isset($_POST['update'])) {
        $payment_id = $_POST['payment_id'];
        $member_amount = $_POST['member_amount'];
        $payment_date = $_POST['payment_date'];
        $status = $_POST['status'];

        // Update payment data in the database
        $sql = "UPDATE payment SET member_amount='$member_amount', payment_date='$payment_date', status='$status' WHERE payment_id='$payment_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Payment data updated successfully!</p>";
        } else {
            echo "Error updating payment data: " . $conn->error;
        }
    }

    if (isset($_POST['payment_id'])) {
        $payment_id = $_POST['payment_id'];

        // Fetch payment data from the database
        $sql = "SELECT * FROM payment WHERE payment_id='$payment_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="">
                <?php if (isset($row['payment_id'])): ?>
                    <input type="hidden" name="payment_id" value="<?php echo $row['payment_id']; ?>">
                <?php endif; ?>
                <div class="form-row">
                    <label>Amount:</label>
                    <input type="text" name="member_amount" value="<?php echo isset($row['member_amount']) ? $row['member_amount'] : ''; ?>">
                </div>
                <div class="form-row">
                    <label>Status:</label>
                    <select name="status">
                        <option value="Paid" <?php if(isset($row['status']) && $row['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                        <option value="Unpaid" <?php if(isset($row['status']) && $row['status'] == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Payment Date:</label>
                    <input type="date" name="payment_date" value="<?php echo isset($row['payment_date']) ? $row['payment_date'] : ''; ?>">
                </div>
                <input type="submit" name="update" value="Update">
            </form>
            <?php
        } else {
            echo "<p>No payment found.</p>";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
  </div> 
    <div class="footer">
      <p>&copy; Copyright 2023 Muscle Maniac</p>
    </div>
  </div>
</body>
</html>