<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #F7F5E8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .navbar-custom {
      background-color #F7F5E8;
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
      gap: 40px;
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
      width: 90%;
      background-color: #F7F5E8;
      border-radius: 12px;
      padding: 10px 40px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      gap: 20px;

    }


    .left-section {
      flex: 1;
      padding: 40px;
      padding-top: 0px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background-color: #f7f5e8;
    }

    .left-section h1 {
      font-size: 4rem;
      color: #333;
      margin-bottom: 10px;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
    }

    .left-section p {
      font-size: 1.5rem;
      color: #666;
      margin-bottom: 20px;
    }

    .left-section label {
      font-size: 1.5rem;
      color: #555;
      margin-bottom: 5px;
      display: block;
    }

    .left-section input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1.5rem;
    }

    .left-section button {
      width: 100%;
      padding: 10px;
      background-color: #605f4b;
      color: #f7f5e8;
      font-size: 2rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .left-section button:hover {
      background-color: #cdad85;
      color: #f7f5e8;
    }


    .right-section {
      flex: 1;
      background-color: #f7f5e8;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .right-section .illustration img {
      max-width: 100%;
      height: auto;
      position: relative;
      margin-top: 0px;
    }

    .right-section::before {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background-color: #faf7f0;
      border-radius: 50%;
      top: 20%;
      left: 10%;
      z-index: -1;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        height: auto;
      }

      .right-section {
        display: none;
      }
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
    <!-- Left Section: Login Form -->
    <div class="left-section col-sm-12 col-md-6">
      <h1>Login</h1>
      <p>Welcome! Log in to your dashboard management system.</p>
      <form action="loginAction.php" method="POST">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="id">ID</label>
        <input type="id" id="id" name="id" placeholder="Enter your ID" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Login</button>

      </form>
    </div>

    <!-- Right Section: Illustration -->
    <div class="right-section col-sm-12 col-md-6">
      <img src="images/login1.png" alt="Dashboard Illustration">
    </div>
  </div>
</body>

</html>