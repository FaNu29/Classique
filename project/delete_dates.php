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


$deleteQuery = "UPDATE courses SET presentation_due_date = NULL, viva_due_date = NULL, 
                tutorial1_due_date = NULL, tutorial2_due_date = NULL 
                WHERE course_code = '$courseCode'";

if (mysqli_query($conn, $deleteQuery)) {
    echo "<script>
            alert('Probable dates deleted successfully!');
            window.location.href = 'teacherHome.php?courseCode=$courseCode';
          </script>";
} else {
    echo "Error deleting probable dates: " . mysqli_error($conn);
}
?>
