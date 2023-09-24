<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Perform validation and authentication checks
  if ($username === 'admin' && $password === '0000') {
    // Successful login
    header('Location: dashboard.php');
    exit;
  } else {
    // Invalid login
    $errorMessage = "Invalid username or password. Please try again.";
  }
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
    <title>Gym Project</title>
<style>
    body {
      font-family: 'Bahnschrift', sans-serif;
      background-color: #f1f1f1;
      background-image: url(4.jpg);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment:fixed;
    }
    .login {
        top: 50%;
        left: 50%;
        width: 32em;
        height: 22.5em;
        padding-top:20px;
        margin-top: -9em;
        margin-left: -15em;
        padding-left: 20px;
        border: 1px ;
        background-color:  #f2f2f2;
        position: fixed;
    }

    .login img {
        padding-left: 200px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 90%;
      padding: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    .form-group input[type="submit"] {
       
      padding: 10px;
      border-radius: 3px;
      border: none;
      background-color: #0080ff;
      color: #ffffff;
      cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
     transition: 0.4s;
    padding-left: 30px;
      background-color: #0000ff;
    }
    .login a{
      color: black;
      text-decoration: none;
      font-size: 15px;
    }
  </style>
</head>
<body>
  <div class="login">
    <img src="Muscle1.png" alt="logo" width="100px" height="80px">
    <hr style="width:50%;">
    <form  method="POST"action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php if (isset($errorMessage)): ?>
    <p><?php echo $errorMessage; ?></p>
  <?php endif; ?>
      <div class="form-group">
        <label for="username"><i class="fas fa-user"></i> Username:</label>
        <input type="text" id="username" placeholder="Username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password"><i class="fas fa-lock"></i> Password:</label>
        <input type="password" id="password"  placeholder="Password" name="password" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Log In ➔">
      </div>
      <a href="index.html">↩ Return</a>
    </form>
  </div>
</body>
</html>