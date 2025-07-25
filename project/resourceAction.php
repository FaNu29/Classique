<?php

session_start(); 

include('config.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $resourceLink = $_POST['resourceLink'];
    $courseCode = $_SESSION['courseCode'];

   
    if (!isset($_SESSION['user_id'])) {
        
        echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php'; 
          </script>";
    }

    
    $teacherId = $_SESSION['user_id'];

    
    $query = "INSERT INTO resources (course_code, teacher_id, resource_link) 
              VALUES ('$courseCode', '$teacherId', '$resourceLink')";

    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Resourse saved successfully');</script>";
        echo "<script>window.history.back();</script>";
    
    } else {
        echo "<script>alert('Failed to save: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>
