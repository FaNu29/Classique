<?php
session_start();
include('config.php');


if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php';
          </script>";
    exit;
}

$teacherId = $_SESSION['user_id'];
$courseCode = $_GET['courseCode']; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated marks values from the form
    $midExamMarks = $_POST['mid_exam_marks'];
    $finalExamMarks = $_POST['final_exam_marks'];
    $attendanceMarks = $_POST['attendance_marks'];
    $assignmentMarks = $_POST['assignment_marks'];
    $vivaMarks = $_POST['viva_marks'];
    $presentationMarks = $_POST['presentation_marks'];
    $tutorialMarks = $_POST['tutorial_marks'];

    // Update query
    $updateQuery = "UPDATE course_layout SET mid_exam_marks = '$midExamMarks', final_exam_marks = '$finalExamMarks', 
                    attendance_marks = '$attendanceMarks', assignment_marks = '$assignmentMarks', 
                    viva_marks = '$vivaMarks', presentation_marks = '$presentationMarks', tutorial_marks = '$tutorialMarks' 
                    WHERE course_code = '$courseCode'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>
                alert('Course layout updated successfully!');
                window.location.href = 'batchHome.php?courseCode=$courseCode';
              </script>";
    } else {
        echo "Error updating course layout: " . mysqli_error($conn);
    }
} else {
    // Fetch current layout details
    $layoutQuery = "SELECT * FROM course_layout WHERE course_code = '$courseCode'";
    $layoutResult = mysqli_query($conn, $layoutQuery);
    $courseLayout = mysqli_fetch_assoc($layoutResult);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course Layout</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F7F5E8
        }
        
        img {
            margin-top: 50px;
            width: 100%;
            height: auto;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .btn-success {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <!-- Image Section (col-md-6) -->
            <div class="col-md-6 mb-4">
                <img src="images/update.png" alt="Course Image" class="img-fluid rounded">
            </div>

            <!-- Form Section (col-md-6) -->
            <div class="col-md-6">
                <div class="form-container">
                    <h1>Update Course Layout for <?php echo htmlspecialchars($courseCode); ?></h1>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="mid_exam_marks" class="form-label">Mid Exam Marks:</label>
                            <input type="number" name="mid_exam_marks" class="form-control" value="<?php echo $courseLayout['mid_exam_marks']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="final_exam_marks" class="form-label">Final Exam Marks:</label>
                            <input type="number" name="final_exam_marks" class="form-control" value="<?php echo $courseLayout['final_exam_marks']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="attendance_marks" class="form-label">Attendance Marks:</label>
                            <input type="number" name="attendance_marks" class="form-control" value="<?php echo $courseLayout['attendance_marks']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="assignment_marks" class="form-label">Assignment Marks:</label>
                            <input type="number" name="assignment_marks" class="form-control" value="<?php echo $courseLayout['assignment_marks']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="viva_marks" class="form-label">Viva Marks:</label>
                            <input type="number" name="viva_marks" class="form-control" value="<?php echo $courseLayout['viva_marks']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="presentation_marks" class="form-label">Presentation Marks:</label>
                            <input type="number" name="presentation_marks" class="form-control" value="<?php echo $courseLayout['presentation_marks']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tutorial_marks" class="form-label">Tutorial Marks:</label>
                            <input type="number" name="tutorial_marks" class="form-control" value="<?php echo $courseLayout['tutorial_marks']; ?>">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
