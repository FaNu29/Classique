<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are not logged in. Please log in first.');
            location.href = 'login.php'; 
          </script>";
    exit;
}

include('config.php');

//courseCode, batchName, and section as URL parameters
$courseCode = $_GET['course_code'];
$batchName = $_GET['batch_name'];
$section = $_GET['section'];


$studentsQuery = "SELECT student_id FROM student_batch WHERE course_code='$courseCode' AND batch_name='$batchName' AND section='$section'";
$studentsResult = mysqli_query($conn, $studentsQuery);


if (!$studentsResult) {
    echo "<script>alert('Failed: " . mysqli_error($conn) . "');</script>";
    echo "<script>window.history.back();</script>";
}


$crStudentsQuery = "SELECT student_id FROM student_batch WHERE cr = 'yes' AND course_code='$courseCode' AND batch_name='$batchName' AND section='$section'";
$crStudentsResult = mysqli_query($conn, $crStudentsQuery);


if (!$crStudentsResult) {
    echo "<script>alert('Failed: " . mysqli_error($conn) . "');</script>";
    echo "<script>window.history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Details</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f8fa;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: #9fc7aa padding: 10px 20px;
        }

        .navbar .navbar-brand {
            color: #fff;
            font-size: 24px;
        }

        .navbar .nav-link {
            color: #fff;
            padding: 8px 20px;
        }

        .navbar .nav-link:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }

        /* Sidebar */
        .nav-side-bar {
            background-color: #9fc7aa;
            padding: 30px;
            height: 100vh;
            box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .nav-side-bar h4 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        .nav-side-bar ul {
            list-style-type: none;
            padding: 0;
        }

        .nav-side-bar .nav-item {
            margin: 15px 0;
        }

        .nav-side-bar .nav-link {
            color: #ecf0f1;
            font-size: 18px;
            padding: 12px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
        }

        .nav-side-bar .nav-link:hover {
            background-color: #34495e;
            color: #fff;
            text-decoration: none;
        }

        /* Sidebar active link*/
        .nav-side-bar .nav-link.active {
            background-color: #1abc9c;
            color: #fff;
        }

        /* Highlighting active link on hover */
        .nav-side-bar .nav-link:hover {
            background-color: #16a085;
            color: #fff;
        }

        .nav-side-bar .nav-link i {
            margin-right: 10px;
        }

        /* Main Content */
        .container {
            display: flex;
            padding: 30px;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .main-content {
            flex-grow: 1;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-right: 30px;
        }

        .student-card,
        .cr-student-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .student-card:hover,
        .cr-student-card:hover {
            background-color: #f9f9f9;
        }

        .student-info {
            display: flex;
            flex-direction: column;
        }

        .student-info h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .student-info p {
            font-size: 14px;
            margin: 5px 0;
            color: #777;
        }

        .student-card .view-details {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }

        .student-card .view-details:hover {
            text-decoration: underline;
        }

        .cr-student-info {
            font-size: 14px;
            color: #333;
        }

        .batch-info {
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }

        .batch-info h2 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .batch-info h3 {
            font-size: 16px;
            color: #777;
            margin-top: 5px;
        }

        .students-list h2,
        .cr-student-info h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .students-container {
            display: flex;
            flex-direction: column;
        }

        .cr-student-card {
            background-color: #e0f7fa;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Sidebar -->

        <div class="col-md-2 p-4 nav-side-bar">
            <h4 class="text-center">Classique</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="teacherHome.php" class="nav-link">Courses</a></li>

        </div>

        <!-- Main Content: Students -->
        <div class="main-content">
            <div class="batch-info">
                <h2>Batch: <?php echo htmlspecialchars($batchName . " - " . $section); ?></h2>
                <h3>Course Code: <?php echo htmlspecialchars($courseCode); ?></h3>
            </div>

            <!-- List of Students -->
            <div class="students-list">
                <h2>Students Enrolled:</h2>
                <div class="students-container">
                    <?php while ($studentBatch = mysqli_fetch_assoc($studentsResult)): ?>
                        <?php
                        $studentQuery = "SELECT name, email, student_id FROM student WHERE student_id = '" . $studentBatch['student_id'] . "'";
                        $studentResult = mysqli_query($conn, $studentQuery);


                        if (!$studentResult) {
                            echo "<script>alert('Error fetching student info:" . mysqli_error($conn) . "');</script>";
                            echo "<script>window.history.back();</script>";
                        
                        }
                        $student = mysqli_fetch_assoc($studentResult);
                        ?>
                        <div class="student-card">
                            <div class="student-info">
                                <h3><?php echo htmlspecialchars($student['name']); ?></h3>
                                <p>Email: <?php echo htmlspecialchars($student['email']); ?></p>
                                <p>Student ID: <?php echo htmlspecialchars($student['student_id']); ?></p>

                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar: CR Students Info -->
        <div class="sidebar">
            <h2>Students with Course Registration (CR)</h2>
            <div class="cr-student-info">
                <?php
                
                while ($crStudentBatch = mysqli_fetch_assoc($crStudentsResult)) {
                    
                    $crStudentQuery = "SELECT name, email, student_id FROM student WHERE student_id = '" . $crStudentBatch['student_id'] . "'";
                    $crStudentResult = mysqli_query($conn, $crStudentQuery);

                    // Check for query errors for CR student info
                    if (!$crStudentResult) {
                        echo "<script>alert('Error fetching CR student info: " . mysqli_error($conn) . "');</script>";
                        echo "<script>window.history.back();</script>";
            
                    }
                    $crStudent = mysqli_fetch_assoc($crStudentResult);
                    echo '<div class="cr-student-card">';
                    echo '<p><strong>Name:</strong> ' . htmlspecialchars($crStudent['name']) . '</p>';
                    echo '<p><strong>Email:</strong> ' . htmlspecialchars($crStudent['email']) . '</p>';
                    echo '<p><strong>Student ID:</strong> ' . htmlspecialchars($crStudent['student_id']) . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>