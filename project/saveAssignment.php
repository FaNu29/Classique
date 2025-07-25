<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $courseCode = $_SESSION['courseCode'];
    $teacherId = $_SESSION['user_id'];
    $assignmentTitle = $_POST['assignmentTitle'];
    $assignmentDescription = $_POST['assignmentDesc'];
    $dueDate = $_POST['assignmentDue'];

    
    $countQuery = "SELECT COUNT(*) AS total_assignments FROM assignments WHERE course_code = '$courseCode'";
    $countResult = mysqli_query($conn, $countQuery);
    $row = mysqli_fetch_assoc($countResult);
    $totalAssignments = $row['total_assignments'];

    
    if ($totalAssignments == 0) {
        $assignmentNumber = 1;
    }
    
    elseif ($totalAssignments == 1) {
        $assignmentNumber = 2;
    }
    else {
        echo "<script>alert('Both assignments already exist');</script>";
         echo "<script>window.history.back();</script>";
        
    }

    
    $query = "INSERT INTO assignments (course_code, teacher_id, assignment_title, assignment_description, due_date, assignment_number) 
              VALUES ('$courseCode', '$teacherId', '$assignmentTitle', '$assignmentDescription', '$dueDate', '$assignmentNumber')";
    
   
    $result = mysqli_query($conn, $query);

   
    if ($result) {
        echo "<script>alert('Assignment saved successfully');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        echo "<script>alert('Failed to save: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>
