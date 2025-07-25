<?php
session_start();
if (isset($_SESSION['error_message'])) {
    echo "<p style='color:red;'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['success_message'])) {
    echo "<p style='color:green;'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Signup Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F7F5E8;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }

        .navbar-custom {
            background-color: #F7F5E8;
            border: none;
            height: 50px;
        }

        .navbar-custom .navbar-brand {
            color: rgb(195, 163, 125);
            font-family: Copperplate, Papyrus, fantasy;
            font-weight: bold;
        }

        .navbar-custom .navbar-nav>li {
            margin-right: 20px;
        }

        .navbar-custom .navbar-nav>li>a {
            color: #605f4b;
        }

        .navbar-custom .navbar-brand {
            color: #605f4b;
            font-family: Copperplate, Papyrus, fantasy;
            font-weight: bold;
        }

        .navbar-custom .navbar-nav>.active>a {
            background-color: #605f4b;
            color: #f7f5e8;
            border-radius: 20px;
        }

        .navbar-custom .navbar-nav>li>a:hover {
            transform: scale(1.2);
            color: #f7f5e8;
            border-radius: 10px;
            background-color: #cdad85;
            font-style: oblique;
        }

        .navbar-custom .navbar-right>li>a {
            color: #53583E;
            gap: 20;
        }

        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            width: 100%;
            background-color: #F7F5E8;
            border-radius: 12px;
            padding: 20px;
        }

        .left-section {
            flex: 1;
            text-align: center;
        }

        .left-section h1 {
            font-size: 3.5rem;
            margin-top: 100px;
            position: absolute;
            z-index: 5;
            color: #333;
        }

        .left-section .illustration img {
            max-width: 100%;
            height: auto;
            position: relative;
            margin-top: 0px;
        }

        .right-section {
            margin-top: 90px;
            flex: 1;
        }

        .right-section form {
            display: flex;
            flex-direction: column;
        }

        .right-section label {
            font-size: 2rem;
            color: #555;
            margin-bottom: 5px;
        }

        .right-section input,
        .right-section textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.2rem;
        }

        .registration-choice {
            text-align: center;
            margin-top: 150px;
        }

        .registration-choice h2 {
            font-size: 3.5rem;
            color: #555;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button-group .btn {
            font-size: 2.5rem;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
        }

        .button-group .btn:hover {
            transform: scale(1.1);
        }

        .button-group .btn-primary {
            background-color: rgb(113, 133, 142);
            color: white;
        }

        .button-group .btn-primary:hover {
            background-color: #605f4b;
        }

        .button-group .btn-success {
            background-color: rgb(200, 164, 119);
            color: white;
        }

        .button-group .btn-success:hover {
            background-color: #605f4b;
        }

    </style>
</head>

<body>
<nav class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Classique</a>
            </div>
            
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="registerFirstPage.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            
        </div>
    </nav>

    <div class="container">
        <!-- Left Section -->
        <div class="left-section col-xs-12 col-sm-6">
            <div class="illustration">
                <h1>Let’s scale your brand, together</h1>
                <img src="images/signup.png" alt="Illustration">
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section col-xs-12 col-sm-6">
            <div class="registration-choice">
                <h2>Are you a student or a teacher?</h2>
                <div class="button-group">
                    <a href="studentRegister.php" class="btn btn-primary">Student</a>
                    <a href="teacherRegister.php" class="btn btn-success">Teacher</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
