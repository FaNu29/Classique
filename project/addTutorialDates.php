<?php
session_start(); 

include('config.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $tutorial1Date = $_POST['tutorial1Date'];
    $tutorial2Date = $_POST['tutorial2Date'];
    $courseCode = $_SESSION['courseCode']; 

    
    
    if (!isset($_SESSION['user_id'])) {
        
        echo "<script>location.href = 'login.php';</script>";
        exit;
    }

    
    $query = "UPDATE courses 
              SET tutorial1_due_date = '$tutorial1Date', 
                  tutorial2_due_date = '$tutorial2Date' 
              WHERE course_code = '$courseCode'";

    
    if (mysqli_query($conn, $query)) {
        
        echo "<script>alert('Tuitorial Dates Saved');</script>";
        echo "<script>window.history.back();</script>";

        
    } else {
        
        
        echo "<script>alert('Failed to save: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";

    }
}
?>
