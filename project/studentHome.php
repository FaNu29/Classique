<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php'; // Redirect to login page
          </script>";
    exit;
}

include('config.php'); 

$studentId = $_SESSION['user_id']; // Use the student ID from the session

// Fetch courses from the student_batch table for this student
$coursesQuery = "SELECT sb.course_code, sb.course_name 
                 FROM student_batch sb
                 WHERE sb.student_id = '$studentId'";
$coursesResult = mysqli_query($conn, $coursesQuery);


if (!$coursesResult) {
    echo "Error fetching courses: " . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classique</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f5e8;
        }

        /* Sidebar */
        .sidebar {
            background-color: rgba(222, 235, 230, 0.82);
            min-height: 100vh;
            color: #fff;
        }

        .sidebar a {
            color: #fff;
            font-weight: bold;
            color: rgb(94, 68, 36);
            ;
            text-decoration: none;
        }

        .sidebar a:hover {
            color: rgb(53, 46, 35);
            transform: scale(1.02);
        }

        /* Header Section */
        .header {
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            /* This makes the items space out */
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header h4 {
            font-size: 22px;
            color: #333;
            margin: 0;
        }

        .header .logout-btn {
            background-color: #605f4b;
            color: #fff;
            padding: 8px 20px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .header .logout-btn:hover {
            background-color: #605f4b;
            transform: scale(1.02);
        }

        /* Courses Section */
        .add-course-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .add-course-container button {
            border-radius: 30px;
            padding: 15px 25px;
            background-color: #605f4b;
            color: #fff;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        a {
            text-decoration: none;
            color: #999;
        }

        .add-course-container button:hover {
            color: rgb(53, 46, 35);
            transform: scale(1.02);
        }

        /* Course List */
        .course-card {
            background-color: #f1f1f1;
            background-image: url('images/TEACHER_card.png');
            
            background-size: cover;
            background-position: center;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 170px;
            color: white;
        }


        .course-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .course-card-body {
            padding: 40px;
            /* Increase padding for a bigger card */
        }

        .course-card .course-code {
            font-size: 24px;
            font-weight: bold;
            color: #0277bd;
        }

        .course-card .course-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #605f4b;
        }

        .course-card .teacher-name {
            font-size: 1rem;
            color: #ddd;
            color: #605f4b;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .container-fluid {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 p-3"
                style="background: url('images/sidebar.png'); min-height: 100vh; border-right: 1px solid #ddd;">
                <h4 class="mb-4">Classique</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-3"><a href="home.php" class="nav-link">Home</a></li>
                    <li class="nav-item mb-3"><a href="teacherHome.php" class="nav-link">Courses</a></li>

                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="row main-image-section">
                    <!-- Course Image and Name -->
                    <img src="images/batchHome.png" class="card-img-top" alt="Course Image">
                    <div class="header mb-4">
                        <div>
                            <h4>Welcome</h4>
                            <h5>ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?></h5>
                        </div>
                        <!-- Logout Button on the Right -->
                        <form action="logout.php" method="post">
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>


                    <!-- Add New Course Button -->
                    <div class="add-course-container">
                        <a href="student_add_course.php" class="btn btn-success btn-sm">Add New Course</a>
                    </div>

                    <!-- Courses Title -->
                    <div class="mb-4">
                        <h3>Your Courses</h3>
                    </div>

                    <!-- Courses List -->
                    <div class="row">
                        <?php while ($course = mysqli_fetch_assoc($coursesResult)): ?>
                            <div class="col-md-12 mb-4">
                                <!-- Make the card clickable by wrapping it in an anchor tag -->
                                <a
                                    href="student_course_show.php?course_code=<?php echo urlencode($course['course_code']); ?>">
                                    <div class="course-card">
                                        <div class="course-card-body">
                                            <div class="course-code"><?php echo htmlspecialchars($course['course_code']); ?>
                                            </div>
                                            <div class="course-title">
                                                <?php echo htmlspecialchars($course['course_name']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>