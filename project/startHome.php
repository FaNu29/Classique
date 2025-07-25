<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Classique</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fcff;
            color: #333;
        }

        .navbar-custom {
            background-color: #F7F5E8 !important;
            border: none;
            z-index: 1000;
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
        }

    

        .container {
            justify-content: space-between;
            max-width: 1500px;
            width: 100%;
            background-color: #F7F5E8;
            border-radius: 12px;
            padding-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            gap: 20px;
        }

        /* Header section */
        .header {
            background: url('images/home.png') no-repeat center center/contain;
            color: white;
            height: 700px;
            text-align: center;
            border-radius: 40px;
            padding-top: 100px;
            background-size: cover;
        }

        .header h1 {
            font-size: 4rem;
            margin: 0;
            color: #605f4b;
            padding-top: 200px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
        }

        .header p {
            font-size: 1.5rem;
            color: #605f4b;
            margin: 10px 0 20px;
        }

        .header button {
            background-color: #c8ac94;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .header button:hover {
            background-color: #baaf9d;
        }

        /* Offer Section */
        .offer {
            text-align: center;
            padding: 40px 20px;
            height: 250px;
            background-color: #f7f5e8;
        }

        .offer h2 {
            font-size: 3.5rem;
            margin-bottom: 15px;
            color: rgb(164, 150, 127);
        }

        .offer p {
            font-size: 1.5rem;
            margin: 0 auto 30px;
            max-width: 800px;
            color: #333;
        }

        /* Features Section */
        .features {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            padding: 50px 20px;
            background-color: #fff;
        }

        .feature-item {
            background-color: #aed3b0;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 25px;
            width: 100%;
            height: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: scale(1.05);
        }

        .feature-item h3 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #e4e7da;
        }

        .feature-item p {
            font-size: 1.2rem;
            color: #555;
        }

        /* Benefits Section */
        .benefits {
            background-color: #f1f8e9;
            padding: 40px 20px;
            text-align: center;
        }

        .benefits h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #388e3c;
        }

        .benefits p {
            font-size: 1.5rem;
            margin: 10px auto;
            max-width: 700px;
            color: #333;
        }

        /* Contact Us and Illustration Section Layout */
        .contact-illustration {
            display: flex;
            justify-content: space-between;
            padding: 40px 20px;
            background-color: #f7f5e8;
        }

        /* Contact Us Section */
        .contact-us {
            width: 48%;
        }

        .contact-us h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #00796b;
        }

        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .contact-item {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-item h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #00796b;
        }

        .contact-item p {
            font-size: 1rem;
            color: #555;
        }

        /* Illustration Section */
        .illustration {
            width: 48%;
        }

        .illustration img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Classique</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="registerFirstPage.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Your Roadmap to Classique</h1>
            <p>Gain valuable skills with Classique. Take one step closer to mastering your course and achieving your
                academic goals today!</p>

            <button onclick="window.location.href='login.php';">Get Started</button>
        </div>

        <!-- Offer Section -->
        <div class="offer">
            <h2>Our Offer</h2>
            <p>Our goal is to educate, practice, and grow product management industry skills. Everything you need in one
                place.</p>
        </div>

        <!-- Features Section -->
        <div class="features row">
            <div class="feature-item col-xs-12 col-sm-4">
                <h3>Learn</h3>
                <p>Gain the knowledge and tools you need to create roadmaps and strategies.</p>
            </div>
            <div class="feature-item col-xs-12 col-sm-4">
                <h3>Practice</h3>
                <p>Hands-on practice to apply the tools effectively in real-world scenarios.</p>
            </div>
            <div class="feature-item col-xs-12 col-sm-4">
                <h3>Grow</h3>
                <p>Improve your career and make strides towards your goals.</p>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="benefits">
            <h2>Benefits</h2>
            <p>Enhance your learning experience with Classique's automated tools and valuable insights.</p>

            <p>Free to use and easy to set up!</p>
        </div>

        <!-- Contact Us and Illustration Section -->
        <div class="contact-illustration row">
            <!-- Contact Us Section -->
            <div class="contact-us col-xs-12 col-md-6">
                <h2>Contact Us</h2>
                <div class="contact-details">
                    <div class="contact-item">
                        <h3>Phone</h3>
                        <p>(088 ) 123-4567</p>
                    </div>
                    <div class="contact-item">
                        <h3>Email</h3>
                        <p>support@classify.com</p>
                    </div>
                    <div class="contact-item">
                        <h3>Address</h3>
                        <p>Sheikhghat, Sylhet</p>
                    </div>
                </div>
            </div>

            <!-- Illustration Section -->
            <div class="illustration col-xs-12 col-md-6">
                <img src="images/home_end.png" alt="Illustration">
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>