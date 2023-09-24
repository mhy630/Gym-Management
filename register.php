<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            font-family: 'Bahnschrift', sans-serif;
            background-color: #f1f1f1;
            background-image: url(4.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .container {
            background-color: white;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 5px;
            font-size: 16px;
        }
        .form-group.row {
            display: flex;
            justify-content: space-between;
        }
        .form-group.row .col-6 {
            width: 45%;
        }
        .submit-btn {
            display: block;
            width: 50%;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .submit-btn-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align:center;">Member Registration Form</h2>
        <form action="regphp.php" method="POST">
       <?php if (isset($_GET["success"])) {
            $successMessage = $_GET["success"];
            echo '<p style="color: green;">' . $successMessage . '</p>';
        }
        ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="col-6">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
                <div class="col-6">
                    <label for="startdate">Start Date:</label>
                    <input type="date" id="startdate" name="startdate" required>
                </div>
            </div>
            <div class="form-group">
                <label for="membershiptype">Membership Type:</label>
                <select id="membershiptype" name="membershiptype" required>
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                    <option value="gold">Gold</option>
                </select>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="weight">Weight:</label>
                    <input type="number" id="weight" name="weight" required>
                </div>
                <div class="col-6">
                    <label for="height">Height:</label>
                    <input type="text" id="height" name="height" required>
                </div>
            </div>
            <div class="form-group">
                <label for="trainer">Trainer:</label>
                <select id="trainer" name="trainer">
                    <option value="trainer1">Trainer 1</option>
                    <option value="trainer2">Trainer 2</option>
                    <option value="trainer3">Trainer 3</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <select id="course" name="course">
                    <option value="fitness">Fitness</option>
                    <option value="yoga">Yoga</option>
                    <option value="muscle">Muscle</option>
                    <option value="strength">Strength</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="submit-btn-container">
                  <input type="submit" value="Submit" class="submit-btn">
                </div>
    </div>
        </form>
    </div>
</body>
</html>
