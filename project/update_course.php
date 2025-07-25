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

// Fetch current course details to prefill the form
$query = "SELECT * FROM courses WHERE course_code = '$courseCode'";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Error fetching course details: " . mysqli_error($conn);
    exit;
}
$courseDetails = mysqli_fetch_assoc($result);

// Handle the update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newCourseCode = $_POST['course_code'];
    $newCourseTitle = $_POST['course_title'];
    
    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // 1. Update in the 'courses' table
        $updateCourseQuery = "UPDATE courses SET course_code = '$newCourseCode', course_name = '$newCourseTitle' WHERE course_code = '$courseCode'";
        if (!mysqli_query($conn, $updateCourseQuery)) {
            throw new Exception("Error updating course: " . mysqli_error($conn));
        }

        // 2. Update in the 'course_layout' table
        $updateLayoutQuery = "UPDATE course_layout SET course_code = '$newCourseCode' WHERE course_code = '$courseCode'";
        if (!mysqli_query($conn, $updateLayoutQuery)) {
            throw new Exception("Error updating course layout: " . mysqli_error($conn));
        }

        // 3. Update in the 'assignments' table 
        $updateAssignmentsQuery = "UPDATE assignments SET course_code = '$newCourseCode' WHERE course_code = '$courseCode'";
        if (!mysqli_query($conn, $updateAssignmentsQuery)) {
            throw new Exception("Error updating assignments: " . mysqli_error($conn));
        }

        // 4. Update in the 'resources' table
        $updateResourcesQuery = "UPDATE resources SET course_code = '$newCourseCode' WHERE course_code = '$courseCode'";
        if (!mysqli_query($conn, $updateResourcesQuery)) {
            throw new Exception("Error updating resources: " . mysqli_error($conn));
        }

        // 5. Update in the 'course_batches' table
        $updateBatchesQuery = "UPDATE course_batches SET course_code = '$newCourseCode' WHERE course_code = '$courseCode'";
        if (!mysqli_query($conn, $updateBatchesQuery)) {
            throw new Exception("Error updating course batches: " . mysqli_error($conn));
        }

        // 6. Update  in the 'student_batch' table 
        $updateStudentBatchQuery = "UPDATE student_batch SET course_code = '$newCourseCode' WHERE course_code = '$courseCode'";
        if (!mysqli_query($conn, $updateStudentBatchQuery)) {
            throw new Exception("Error updating student batch associations: " . mysqli_error($conn));
        }

        // Commit the transaction if all queries are successful
        mysqli_commit($conn);

        // Redirect with success message
        echo "<script>
                alert('Course updated successfully.');
                window.location.href = 'teacherHome.php';
              </script>";
    } catch (Exception $e) {
        // Rollback the transaction if any query fails
        mysqli_rollback($conn);

        // Display the error message
        echo "<script>
                alert('Failed to update course. Error: " . $e->getMessage() . "');
                window.location.href = 'teacherHome.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Course</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .update-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 80%;
    }

    .form-container {
      width: 50%;
    }

    .form-container h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .form-container input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-container button {
      width: 100%;
      padding: 12px;
      color: #605f4b;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }

    .form-container button:hover {
      color: #605f4b;
      transform: scale(1.02);
    }

    .image-container {
      width: 40%;
      text-align: center;
    }

    .image-container img {
      max-width: 100%;
      height: auto;
      object-fit: contain;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="update-container">
    <!-- Image Section -->
    <div class="image-container">
      <img src="images/update.png" alt="Course Image">
    </div>

    <!-- Form Section -->
    <div class="form-container">
      <h2>Update Course Details</h2>
      <form method="POST">
        <label for="course_code">New Course Code:</label>
        <input type="text" name="course_code" value="<?php echo htmlspecialchars($courseDetails['course_code']); ?>" required><br>

        <label for="course_title">New Course Title:</label>
        <input type="text" name="course_title" value="<?php echo htmlspecialchars($courseDetails['course_name']); ?>" required><br>

        <button type="submit">Update Course</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
