<?php
session_start();
include('config.php');

// Check if teacher is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php';
          </script>";
    exit;
}

$teacherId = $_SESSION['user_id'];
$courseCode = $_GET['courseCode']; // Get course code from URL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated resource link from the form
    $resourceLink = $_POST['resource_link'];

    // Update query
    $updateQuery = "UPDATE resources SET resource_link = '$resourceLink' 
                    WHERE course_code = '$courseCode' AND teacher_id = '$teacherId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>
                alert('Resource updated successfully!');
                window.location.href = 'batchHome.php?courseCode=$courseCode';
              </script>";
    } else {
        echo "Error updating resource: " . mysqli_error($conn);
    }
} else {
    // Fetch current resource details for this course and teacher
    $resourceQuery = "SELECT * FROM resources WHERE course_code = '$courseCode' AND teacher_id = '$teacherId'";
    $resourceResult = mysqli_query($conn, $resourceQuery);
    $resourceDetails = mysqli_fetch_assoc($resourceResult);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Resource</title>
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
            background-color: #28a745;
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
        }

        .btn-update:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Form Section (col-md-6) -->
        <div class="col-md-6 offset-md-3">
            <div class="form-container">
                <h1>Update Resource for <?php echo htmlspecialchars($courseCode); ?></h1>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="resource_link" class="form-label">Resource Link:</label>
                        <input type="url" name="resource_link" id="resource_link" class="form-control" value="<?php echo htmlspecialchars($resourceDetails['resource_link']); ?>" required>
                    </div>
                    <button type="submit" class="btn-update">Update Resource</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional for interactivity) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
