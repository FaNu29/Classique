<?php

session_start();

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $courseCode = $_SESSION['courseCode'];
    $teacherId = $_SESSION['user_id'];
    $midExamMarks = $_POST['midExamMarks'];
    $finalExamMarks = $_POST['finalExamMarks'];
    $attendanceMarks = $_POST['attendanceMarks'];
    $assignmentMarks = $_POST['assignmentMarks'];
    $tutorialMarks = $_POST['tutorialMarks'];
    $vivaMarks = $_POST['vivaMarks'];
    $presentationMarks = $_POST['presentationMarks'];

    
    $query = "INSERT INTO course_layout (course_code, teacher_id, mid_exam_marks, final_exam_marks, attendance_marks, assignment_marks, tutorial_marks, viva_marks, presentation_marks) 
              VALUES ('$courseCode', '$teacherId', '$midExamMarks', '$finalExamMarks', '$attendanceMarks', '$assignmentMarks', '$tutorialMarks', '$vivaMarks', '$presentationMarks')";

    $result = mysqli_query($conn, $query);  

    if ($result) {
        echo "<script>alert('Course Layout saved successfully');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        echo "<script>alert('Failed to save: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>
