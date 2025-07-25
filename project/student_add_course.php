<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }

        .container-fluid {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        h2,
        h3,
        h4,
        h5 {
            font-weight: bold;
            color: #333;
        }

        .btn,
        .form-control {
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
        }

        .nav-item {
            margin-bottom: 20px;
        }

        .nav-link {
            font-weight: bold;
            color: #333;
        }

        .nav-link:hover {
            color: #0056b3;
        }

        .alert-info {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .nav-side-bar {
            background-color: #f7f8fa;
            border-radius: 8px;
            padding: 20px;
        }

        .nav-side-bar a {
            color: #333;
        }

        .nav-side-bar a:hover {
            color: #0056b3;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-row {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-4 nav-side-bar">
                <h4 class="text-center">Classique</h4>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="studentHome.php" class="nav-link">My courses</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Instructors</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="form-container" >
                    <!-- Course Enrollment Form -->
                    <div class="mb-4">
                        <h3 class="mb-4">Student Enrollment</h3>
                        <form action="add_student_course_action.php" method="POST">
                            <div class="form-group">
                                <label for="courseCode">Course Code:</label>
                                <input type="text" id="courseCode" name="courseCode" class="form-control" placeholder="Enter course code" required>
                            </div>
                            <div class="form-group">
                                <label for="courseName">Course Name:</label>
                                <input type="text" id="courseName" name="courseName" class="form-control" placeholder="Enter course name" required>
                            </div>
                            <div class="form-group">
                                <label for="studentId">Student ID:</label>
                                <input type="text" id="studentId" name="studentId" class="form-control" placeholder="Enter student ID" required>
                            </div>
                            <div class="form-group">
                                <label for="batchName">Batch Name:</label>
                                <input type="text" id="batchName" name="batchName" class="form-control" placeholder="Enter batch name" required>
                            </div>
                            <div class="form-group">
                                <label for="section">Section:</label>
                                <input type="text" id="section" name="section" class="form-control" placeholder="Enter section" required>
                            </div>
                            <div class="form-group">
                                <label for="cr">Are you CR? ('yes' or 'no')</label>
                                <input type="text" id="cr" name="cr" class="form-control" placeholder="Enter CR's name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Enroll Student</button>
                        </form>
                    </div>

                    <!-- Display message if any -->
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-info">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
