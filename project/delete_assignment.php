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
$assignmentTitle = $_GET['assignmentTitle']; 


if (empty($assignmentTitle)) {
    echo "<script>
            alert('No assignment title provided.');
            window.location.href = 'batchHome.php?courseCode=$courseCode'; 
          </script>";
    exit;
}


$deleteQuery = "DELETE FROM assignments WHERE course_code = '$courseCode' AND assignment_title = '$assignmentTitle'";

if (mysqli_query($conn, $deleteQuery)) {
    echo "<script>
            alert('Assignment deleted successfully!');
            window.location.href = 'teacherHome.php?courseCode=$courseCode'; // Redirect to course page after deletion
          </script>";
} else {
    echo "Error deleting assignment: " . mysqli_error($conn);
}
?>
