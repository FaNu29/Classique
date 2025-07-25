<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php';
          </script>";
    exit;
}

include('config.php');

$teacherId = $_SESSION['user_id'];
$courseCode = $_GET['courseCode']; 

// Begin the transaction
mysqli_begin_transaction($conn);

try {
    // 1.Delete from the 'course_layout' table
    $layoutDeleteQuery = "DELETE FROM course_layout WHERE course_code = '$courseCode'";
    if (!mysqli_query($conn, $layoutDeleteQuery)) {
        throw new Exception("Error deleting course layout: " . mysqli_error($conn));
    }

    // 2.Delete from the 'assignments' table
    $assignmentsDeleteQuery = "DELETE FROM assignments WHERE course_code = '$courseCode'";
    if (!mysqli_query($conn, $assignmentsDeleteQuery)) {
        throw new Exception("Error deleting assignments: " . mysqli_error($conn));
    }

    //3. Delete from the 'resources' table
    $resourcesDeleteQuery = "DELETE FROM resources WHERE course_code = '$courseCode'";
    if (!mysqli_query($conn, $resourcesDeleteQuery)) {
        throw new Exception("Error deleting resources: " . mysqli_error($conn));
    }

    // 4. Delete from the 'course_batches' table
    $batchesDeleteQuery = "DELETE FROM course_batches WHERE course_code = '$courseCode'";
    if (!mysqli_query($conn, $batchesDeleteQuery)) {
        throw new Exception("Error deleting batches: " . mysqli_error($conn));
    }

    //  5.Delete from the 'student_batch' table
    $studentBatchDeleteQuery = "DELETE FROM student_batch WHERE course_code = '$courseCode'";
    if (!mysqli_query($conn, $studentBatchDeleteQuery)) {
        throw new Exception("Error deleting student_batch data: " . mysqli_error($conn));
    }


    // 6. Delete the course itself from the 'courses' table
    $courseDeleteQuery = "DELETE FROM courses WHERE course_code = '$courseCode'";
    if (!mysqli_query($conn, $courseDeleteQuery)) {
        throw new Exception("Error deleting course: " . mysqli_error($conn));
    }

    // Commit the transaction
    mysqli_commit($conn);

    
    echo "<script>
            alert('Course and all related data deleted successfully.');
          </script>";
    echo "<script>location.href='teacherHome.php'</script>";

} catch (Exception $e) {
    // Rollback the transaction if any query fails
    mysqli_rollback($conn);

    
    echo "<script>
            alert('Failed to delete course. Error: " . $e->getMessage() . "');
          </script>";
    echo "<script>location.href='teacherHome.php'</script>";
}
?>
