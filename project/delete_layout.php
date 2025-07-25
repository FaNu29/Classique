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

// Delete query
$deleteQuery = "DELETE FROM course_layout WHERE course_code = '$courseCode'";

if (mysqli_query($conn, $deleteQuery)) {
    echo "<script>
            alert('Course layout deleted successfully!');
          </script>";
          echo "<script>location.href='teacherHome.php'</script>";
} else {
    echo "Error deleting course layout: " . mysqli_error($conn);
}
?>
