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

// Delete query using course_code and teacher_id
$deleteQuery = "DELETE FROM resources WHERE course_code = '$courseCode' AND teacher_id = '$teacherId'";

if (mysqli_query($conn, $deleteQuery)) {
    echo "<script>
            alert('Resource deleted successfully!');
            window.location.href = 'teacherHome.php?courseCode=$courseCode';
          </script>";
} else {
    echo "Error deleting resource: " . mysqli_error($conn);
}
?>
