<?php

session_start();

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $studentId = $_POST['studentId'];
    $batchName = $_POST['batchName'];
    $section = $_POST['section'];
    $cr = $_POST['cr'];

    $query = "INSERT INTO student_batch (course_code, course_name, student_id, batch_name, section, cr) 
              VALUES ('$courseCode', '$courseName', '$studentId', '$batchName', '$section', '$cr')";

    if (mysqli_query($conn, $query)) {

        echo "<script>alert('Course saved successfully');</script>";
        echo "<script>location.href = 'studentHome.php';</script>";

    } else {

        echo "<script>alert('Failed to save course: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
        

    }
}
?>