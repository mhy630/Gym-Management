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

// Fetch total instructors from the member table
$sqlInstructors = "SELECT COUNT(*) AS total_instructors FROM member WHERE role='instructor'";
$resultInstructors = $conn->query($sqlInstructors);
$totalInstructors = 0;
if ($resultInstructors->num_rows > 0) {
    $rowInstructors = $resultInstructors->fetch_assoc();
    $totalInstructors = $rowInstructors['total_instructors'];
}

// Fetch total members from the member table
$sqlMembers = "SELECT COUNT(*) AS total_members FROM member WHERE role='member'";
$resultMembers = $conn->query($sqlMembers);
$totalMembers = 0;
if ($resultMembers->num_rows > 0) {
    $rowMembers = $resultMembers->fetch_assoc();
    $totalMembers = $rowMembers['total_members'];
}

// Fetch total payment from the payment table
$sqlPayment = "SELECT SUM(amount) AS total_payment FROM payment";
$resultPayment = $conn->query($sqlPayment);
$totalPayment = 0;
if ($resultPayment->num_rows > 0) {
    $rowPayment = $resultPayment->fetch_assoc();
    $totalPayment = $rowPayment['total_payment'];
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
  <title>Dashboard</title>
  <style>
        .container-wrapper {
      margin-left: 300px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      height: 472px;
    }

    .container {
      background-color: #f5f5f5;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-right: 20px;
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    .container:last-child {
      margin-right: 0;
    }

    .container.yellow {
      background-color: #FFA500;
      color: #000;
    }

    .container.black {
      background-color: #000;
      color: #fff;
    }

    .container.grey {
      background-color: #808080;
      color: #fff;
    }

    .container h2 {
      margin: 0;
    }

    .container p {
      margin: 0;
    }

    .container i {
      font-size: 40px;
      margin-bottom: 10px;
    }

    .container .graph {
      width: 100%;
      height: 100px;
      margin-top: 10px;
      overflow: hidden;
    }

    .container .graph .bar {
      height: 100%;
    }
    .container .graph .line {
      stroke-width: 5;
      fill: none;
    }

    .container.yellow .graph .line {
      stroke: black;
    }
    #teach{
    height: 10px;
    border-radius: 5px;
    background-color: white;
    }
    #pay{
    height:10px;
    background-color: #ddd;
    }
    #black{
    height: 180px;
    }
    #grey{
    height: 180px;
    }
    #yellow{
    height: 180px;
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
<div class="blank"></div>
    <div class="container black" id="black">
      <i class="fas fa-chalkboard-teacher"></i>
      <h2>Total Instructors</h2>
      <p>20</p><br>
      <div class="graph">
        <div class="bar" id="teach" style="width: 70%;"></div>
      </div>
    </div>
<div class="container yellow" id="yellow">
      <i class="fas fa-users"></i>
      <h2>Total Members</h2>
      <p>500</p>
      <svg class="graph" viewBox="0 0 100 100">
        <path class="line" d="M 10 90 L 30 70 L 50 50 L 70 30 L 90 70 L 140 15"></path>
      </svg>
    </div>
    <div class="container grey" id="grey">
      <i class="fas fa-dollar-sign"></i>
      <h2>Total Payment</h2>
      <p>$10,000</p><br>
      <div class="graph">
        <div class="bar" id="pay" style="width: 80%;"></div>
      </div>
    </div>
    <div class="blank"></div>
  </div> 
    <div class="footer">
      <p>&copy; Copyright 2023 Muscle Maniac</p>
    </div>
  </div>
</body>
</html>