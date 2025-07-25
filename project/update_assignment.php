<?php
session_start();
include('config.php');


if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php';
          </script>";
    exit;
}

$teacherId = $_SESSION['user_id'];
$courseCode = $_GET['courseCode']; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Loop through each assignment and update it
    if (isset($_POST['assignment_title']) && count($_POST['assignment_title']) > 0) {
        foreach ($_POST['assignment_title'] as $index => $assignmentTitle) {
            $assignmentDescription = $_POST['assignment_description'][$index];
            $dueDate = $_POST['due_date'][$index];
            $assignmentNumber = $_POST['assignment_number'][$index]; // Get the assignment number (1 or 2)

            // Create SQL query to update the assignment
            $updateQuery = "UPDATE assignments 
                            SET assignment_title = '$assignmentTitle', 
                                assignment_description = '$assignmentDescription', 
                                due_date = '$dueDate'
                            WHERE course_code = '$courseCode' AND teacher_id = '$teacherId' AND assignment_number = '$assignmentNumber'";

            // Execute the query
            $result = mysqli_query($conn, $updateQuery);

            if (!$result) {
                echo "Error updating assignment: " . mysqli_error($conn);
                exit;
            }
        }

        // Redirect and show success message
        echo "<script>
                alert('Assignments updated successfully!');
                window.location.href = 'batchHome.php?courseCode=$courseCode';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('No assignments found to update.');
              </script>";
    }
} else {
    // Fetch current assignment
    $assignmentQuery = "SELECT * FROM assignments WHERE course_code = '$courseCode' AND teacher_id = '$teacherId' AND assignment_number IN (1, 2)";
    $assignmentResult = mysqli_query($conn, $assignmentQuery);
    $assignments = mysqli_fetch_all($assignmentResult, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Assignments</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }

        .container {
            margin-top: 50px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-update {
            width: 100%;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
        }

        .btn-update:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="form-container">
                <h1>Update Assignments for <?php echo htmlspecialchars($courseCode); ?></h1>
                <form action="" method="POST">
                    <?php foreach ($assignments as $index => $assignment) { ?>
                        <!-- Hidden field for assignment_number -->
                        <input type="hidden" name="assignment_number[]" value="<?php echo $assignment['assignment_number']; ?>">
                        <h3>Assignment <?php echo $assignment['assignment_number']; ?></h3>

                        <div class="mb-3">
                            <label for="assignment_title_<?php echo $index; ?>" class="form-label">Assignment Title:</label>
                            <input type="text" name="assignment_title[]" id="assignment_title_<?php echo $index; ?>" class="form-control" value="<?php echo htmlspecialchars($assignment['assignment_title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="assignment_description_<?php echo $index; ?>" class="form-label">Assignment Description:</label>
                            <textarea name="assignment_description[]" id="assignment_description_<?php echo $index; ?>" class="form-control" rows="4" required><?php echo htmlspecialchars($assignment['assignment_description']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date_<?php echo $index; ?>" class="form-label">Due Date:</label>
                            <input type="date" name="due_date[]" id="due_date_<?php echo $index; ?>" class="form-control" value="<?php echo $assignment['due_date']; ?>" required>
                        </div>
            
                        <hr>
                    <?php } ?>
                    <button type="submit" class="btn-update">Update Assignments</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional for interactivity) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
