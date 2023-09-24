<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="Muscle1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="gym.css">
  <title>Update Member</title>
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
      height: 500px;
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
    <h2>Edit Member</h2>
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
      $member_id = $_POST['member_id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      // Add the additional attributes here
      $phone = $_POST['phone'];
      $birthdate = $_POST['birthdate'];
      $startdate = $_POST['startdate'];
      $membershiptype = $_POST['membershiptype'];
      $weight = $_POST['weight'];
      $height = $_POST['height'];
      $trainer = $_POST['trainer'];

      // Update member data in the database
      $sql = "UPDATE member SET member_name='$name', member_email='$email', member_phone='$phone', member_birthdate='$birthdate', member_startdate='$startdate', member_membershiptype='$membershiptype', member_weight='$weight', member_height='$height', member_trainer='$trainer' WHERE member_id='$member_id'";

      if ($conn->query($sql) === TRUE) {
        echo "<p>Member data updated successfully!</p>";
      } else {
        echo "Error updating member data: " . $conn->error;
      }
    }

    if (isset($_POST['member_id'])) {
      $member_id = $_POST['member_id'];

      // Fetch member data from the database
      $sql = "SELECT * FROM member WHERE member_id='$member_id'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <form method="post" action="">
  <?php if (isset($row['member_id'])): ?>
    <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
  <?php endif; ?>
  <div class="form-row">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo isset($row['member_name']) ? $row['member_name'] : ''; ?>">
  </div>
  <div class="form-row">
    <label>Email:</label>
    <input type="text" name="email" value="<?php echo isset($row['member_email']) ? $row['member_email'] : ''; ?>">
  </div>
  <!-- Add the additional form rows here -->
  <div class="form-row">
    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo isset($row['member_phone']) ? $row['member_phone'] : ''; ?>">
  </div>
  <div class="form-row">
    <label>Birthdate:</label>
    <input type="date" name="birthdate" value="<?php echo isset($row['member_birthdate']) ? $row['member_birthdate'] : ''; ?>">
  </div>
  <div class="form-row">
    <label>Start Date:</label>
    <input type="date" name="startdate" value="<?php echo isset($row['member_startdate']) ? $row['member_startdate'] : ''; ?>">
  </div>
  <div class="form-row">
    <label>Membership Type:</label>
    <select name="membershiptype">
    <option value="Basic" <?php if(isset($row['member_membershiptype']) && $row['member_membershiptype'] == 'option1') echo 'selected'; ?>>Basic</option>
    <option value="Premium" <?php if(isset($row['member_membershiptype']) && $row['member_membershiptype'] == 'option2') echo 'selected'; ?>>Premium</option>
    <option value="Gold" <?php if(isset($row['member_membershiptype']) && $row['member_membershiptype'] == 'option3') echo 'selected'; ?>>Gold</option>
  </select>

  </div>
  <div class="form-row">
    <label>Weight:</label>
    <input type="number" name="weight" value="<?php echo isset($row['member_weight']) ? $row['member_weight'] : ''; ?>">
  </div>
  <div class="form-row">
    <label>Height:</label>
    <input type="text" name="height" value="<?php echo isset($row['member_height']) ? $row['member_height'] : ''; ?>">
  </div>
  <div class="form-row">
  <label>Trainer:</label>
  <select name="trainer">
    <option value="Trainer1" <?php if(isset($row['member_trainer']) && $row['member_trainer'] == 'trainer1') echo 'selected'; ?>>Trainer 1</option>
    <option value="Trainer2" <?php if(isset($row['member_trainer']) && $row['member_trainer'] == 'trainer2') echo 'selected'; ?>>Trainer 2</option>
    <option value="Trainer3" <?php if(isset($row['member_trainer']) && $row['member_trainer'] == 'trainer3') echo 'selected'; ?>>Trainer 3</option>
  </select>
</div>
<div class="form-row">
  <label>Course:</label>
  <select name="course">
    <option value="fitness" <?php if(isset($row['member_course']) && $row['member_course'] == 'fitness') echo 'selected'; ?>>Fitness</option>
    <option value="yoga" <?php if(isset($row['member_course']) && $row['member_course'] == 'yoga') echo 'selected'; ?>>Yoga</option>
    <option value="muscle" <?php if(isset($row['member_course']) && $row['member_course'] == 'muscle') echo 'selected'; ?>>Muscle</option>
    <option value="strength" <?php if(isset($row['member_strength']) && $row['member_strength'] == 'strength') echo 'selected'; ?>>Strength</option>
  </select>
</div>
  <input type="submit" name="update" value="Update">
</form>
<?php
      } else {
        echo "<p>No member found.</p>";
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