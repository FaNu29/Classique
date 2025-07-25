<?php
session_start();


   include('config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $vivaDate = $_POST['vivaDate'];
    $courseCode = $_SESSION['courseCode']; 

    
    if (!isset($_SESSION['user_id'])) {
       
        echo '<script>alert("You are not logged in")</script>';
    }

    $query = "UPDATE courses 
              SET viva_due_date = '$vivaDate' 
              WHERE course_code = '$courseCode'";

  
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Viva Date Saved');</script>";
        echo "<script>window.history.back();</script>";
        
    } else {
        echo "<script>alert('Failed to save: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>
