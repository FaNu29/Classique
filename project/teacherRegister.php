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
      /* Adjust the value to your preferred gap size */
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
      gap: 20px;

    }

    .left-section {
      flex: 1;
      display: flex;
      flex-direction: column;

      justify-content: center;
      text-align: center;
    }

    .left-section h1 {
      font-size: 3.5rem;
      /* Bigger font size */
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
      margin-top: 100px;
      margin-left: 50px;
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

    .right-section button {
      width: 100%;
      padding: 10px;
      background-color: rgb(200, 164, 119);
      color: #fff;
      font-size: 1.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .right-section button:hover {
      background-color: #605f4b;
    }

    

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: center;
        padding: 20px;
      }

      .left-section {
        text-align: center;
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
    <!-- Left Section -->
    <div class="left-section col-sm-12 col-md-6">
      <div class="illustration">
        <h1>Let’s scale your brand, together</h1>
        <img src="images/signup.png" alt="Illustration">
      </div>
    </div>

    <!-- Right Section -->
    <div class="right-section col-sm-12 col-md-6">

      <div id="form-container">
        <!-- Default: Student Form -->
        <form id="teacher-form" action="teacherRegisterAction.php" method="POST" enctype="multipart/form-data">

           <label for="teacher-id">Teacher ID *</label>
          <input type="text" id="teacher-id" name="teacher-id" placeholder="Type your ID" required>

          <label for="teacher-name">Name *</label>
          <input type="text" id="teacher-name" name="teacher-name" placeholder="Type your name" required>

          <label for="teacher-email">Email *</label>
          <input type="email" id="teacher-email" name="teacher-email" placeholder="Type your email address" required>

          <label for="teacher-password">Password *</label>
          <input type="password" id="teacher-password" name="teacher-password" placeholder="Type your password" required>

          <label for="routine">Routine (Upload A ScreenShot or Image)</label>
          <input type="file" id="routine" name="routine" >

          <label for="offdays">Off Days</label>
          <input type="text" id="offdays" name="offdays" placeholder="Type your off days">

          <button type="submit">Register</button>
        </form>
      </div>
    </div>
  </div>


</body>

</html>