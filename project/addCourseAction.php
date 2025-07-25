<?php
session_start();

include('config.php');


if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Teacher not logged in');</script>";
    echo "<script>location.href = 'login.php';</script>";

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];

    
    $teacherId = $_SESSION['user_id'];

    
    $query = "INSERT INTO courses (course_code, course_name, teacher_id) VALUES ('$courseCode', '$courseName', '$teacherId')";
    $result = mysqli_query($conn, $query);

   
    if (!$result) {
        echo "<script>alert('Failed to save course: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";

    }

    $_SESSION['courseCode'] = $courseCode;

    echo "<script>alert(' Course Saved');</script>";
    echo "<script>window.history.back();</script>";

}
?>