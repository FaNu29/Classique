<?php
session_start();
 

include('config.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $presentationDate = $_POST['presentationDate'];
    $courseCode = $_SESSION['courseCode']; 

    
    if (!isset($_SESSION['user_id'])) {
        
        echo '<script>alert("You are not logged in")</script>';
        exit;
    }

    
    $query = "UPDATE courses 
              SET presentation_due_date = '$presentationDate' 
              WHERE course_code = '$courseCode'";

   
    if (mysqli_query($conn, $query)) {
       
        echo "<script>alert('Presentation Date Saved');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        
        echo "<script>alert('Failed to save course: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>
