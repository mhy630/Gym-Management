<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="Muscle1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="gym.css">
  <title>Member</title>
  <style>
       .container-wrapper {
      margin-left: 300px;
      padding: 20px;
      height: 472px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .container-wrapper button {
      height: 50px;
      width: 90px;
      text-decoration: none;
      border-style: none;
      font-size: 20px;
      padding: 10px;
      color: white;
      background-color: #4caf50; 
      font-weight:bold;
      cursor: pointer;
    }

    .container-wrapper button:hover {
      background-color: #279659;
    }

    table {
      border: collapse;
    }

    th, td {
      background-color: white;
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #FFA500;
      color: black;
    }

    .add-button {
      margin-bottom: 20px;
    }
    .container-wrapper .edit-button {
  background-color: #4CAF50;
  color: white;
  padding: 8px;
  border: none;
  cursor: pointer;
}

.container-wrapper .delete-button {
  background-color: #f44336;
  color: white;
  padding: 8px;
  border: none;
  cursor: pointer;
}
.container-wrapper .edit-button:hover {
  background-color: #45a049;
}

.container-wrapper .delete-button:hover {
  background-color: #d32f2f;
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
<a href="add.php" class="add-button"><button> Add <i class="fas fa-plus"></i></button></a>
<?php
// Check if the member was deleted
session_start();
if (isset($_SESSION['member_deleted']) && $_SESSION['member_deleted']) {
    echo "<p style='color: white; font-weight: bold; margin-top: 10px;'>Member deleted successfully.</p>";
    unset($_SESSION['member_deleted']); // Clear the session variable
}
?>
<table>
  <tr>
    <th>Member ID</th>
    <th>Member Name</th>
    <th>Member Phone</th>
    <th>Member Email</th>
    <th>Member Birthdate</th>
    <th>Member Start Date</th>
    <th>Actions</th>
    <th>Delete</th>
  </tr>
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

  // SQL query to fetch member data
  $sql = "SELECT * FROM member";
  $results = $conn->query($sql);

  if ($results->num_rows > 0) {
    // Output data of each row
    while ($row = $results->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["member_id"] . "</td>";
      echo "<td>" . $row["member_name"] . "</td>";
      echo "<td>" . $row["member_phone"] . "</td>";
      echo "<td>" . $row["member_email"] . "</td>";
      echo "<td>" . $row["member_birthdate"] . "</td>";
      echo "<td>" . $row["member_startdate"] . "</td>";
      echo "<td>
              <form method='post' action='update.php'>
                <input type='hidden' name='member_id' value='" . $row["member_id"] . "'>
                <button type='submit' class='edit-button'>Edit</button>
              </form>
            </td>";
      echo "<td>
            <form method='post' action='delete.php' onsubmit='return confirmDelete()'>
              <input type='hidden' name='member_id' value='" . $row["member_id"] . "'>
              <button type='submit' class='delete-button'>Delete</button>
            </form>
          </td>";

      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='11'>No members found</td></tr>";
  }
  $conn->close();
  ?>
</table>
<div class="blank"></div>
<table>
  <tr>
    <th>Member ID</th>
    <th>Member Weight</th>
    <th>Member Height</th>
    <th>Membership Type</th>
    <th>Member Trainer</th>
    <th>Member Course</th>
    <th>Actions</th>
    <th>Delete</th>
  </tr>
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

  // SQL query to fetch member data
  $sql = "SELECT * FROM member";
  $results = $conn->query($sql);

  if ($results->num_rows > 0) {
    // Output data of each row
    while ($row = $results->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["member_id"] . "</td>";
      echo "<td>" . $row["member_membershiptype"] . "</td>";
      echo "<td>" . $row["member_weight"] . "</td>";
      echo "<td>" . $row["member_height"] . "</td>";
      echo "<td>" . $row["member_trainer"] . "</td>";
      echo "<td>" . $row["member_course"] . "</td>";
      echo "<td>
              <form method='post' action='update.php'>
                <input type='hidden' name='member_id' value='" . $row["member_id"] . "'>
                <button type='submit' class='edit-button'>Edit</button>
              </form>
            </td>";
      echo "<td>
            <form method='post' action='delete.php' onsubmit='return confirmDelete()'>
              <input type='hidden' name='member_id' value='" . $row["member_id"] . "'>
              <button type='submit' class='delete-button'>Delete</button>
            </form>
          </td>";

      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='11'>No members found</td></tr>";
  }
  
  $conn->close();
  ?>
</table>
  </div>
    <div class="footer">
      <p>&copy; Copyright 2023 Muscle Maniac</p>
    </div>
  </div>
</body>
</html>

    

