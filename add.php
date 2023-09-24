<?php
// Function to generate a random member ID
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

// Define your database connection details here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Initialize the success message variable
$successMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $birthdate = $_POST["birthdate"];
  $startdate = $_POST["startdate"];
  $membershiptype = $_POST["membershiptype"];
  $weight = $_POST["weight"];
  $height = $_POST["height"];
  $trainer = $_POST["trainer"];
  $course = $_POST["course"];

  // Generate a member ID
  $memberID = generateMemberID();

  // Prepare and execute the SQL query to insert the data into the database
  $stmt = $conn->prepare("INSERT INTO member (member_id, member_name, member_email, member_phone, member_birthdate, member_startdate, member_membershiptype, member_weight, member_height, member_trainer, member_course) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssssss", $memberID, $name, $email, $phone, $birthdate, $startdate, $membershiptype, $weight, $height, $trainer, $course);
  
  if ($stmt->execute()) {
    $successMessage = "Member Registered Successfully";
  } else {
    $successMessage = "Error: " . $stmt->error;
  }

  // Close the statement
  $stmt->close();

  // Close the database connection
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
  <title>Member Registration Form</title>
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
 <?php if (!empty($successMessage)): ?>
 <p><?php echo $successMessage; ?></p>
 <?php endif; ?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"> 
 <div class="form-row">
    <label>Name:</label>
    <input type="text" name="name">
  </div>
  <div class="form-row">
    <label>Email:</label>
    <input type="text" name="email">
  </div>
  <div class="form-row">
    <label>Phone:</label>
    <input type="text" name="phone">
  </div>
  <div class="form-row">
    <label>Birthdate:</label>
    <input type="date" name="birthdate">
  </div>
  <div class="form-row">
    <label>Start Date:</label>
    <input type="date" name="startdate">
  </div>
  <div class="form-row">
  <label for="membershiptype">Membership Type:</label>
        <select id="membershiptype" name="membershiptype" required>
          <option value="basic">Basic</option>
          <option value="premium">Premium</option>
          <option value="gold">Gold</option>
        </select>

  </div>
  <div class="form-row">
    <label>Weight:</label>
    <input type="number" name="weight">
  </div>
  <div class="form-row">
    <label>Height:</label>
    <input type="text" name="height">
  </div>
  <div class="form-row">
  <label>Trainer:</label>
  <select id="trainer" name="trainer">
          <option value="trainer1">Trainer 1</option>
          <option value="trainer2">Trainer 2</option>
          <option value="trainer3">Trainer 3</option>
        </select>
</select>
</div>
<div class="form-row">
  <label>Course</label>
  <select id="course" name="course">
          <option value="fitness">Fitness</option>
          <option value="yoga">Yoga </option>
          <option value="muscle">Muscle</option>
          <option value="strength">Strength</option>
        </select>
</select>
</div>
  <input type="submit" name="Submit">
  </form>
</div>
  </div> 
    <div class="footer">
      <p>&copy; Copyright 2023 Muscle Maniac</p>
    </div>
  </div>
</body>
</html>
