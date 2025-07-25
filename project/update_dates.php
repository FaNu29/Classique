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
    // Get updated dates from the form
    $presentationDue = $_POST['presentation_due'];
    $vivaDue = $_POST['viva_due'];
    $tutorial1Due = $_POST['tutorial1_due'];
    $tutorial2Due = $_POST['tutorial2_due'];

    // Update query
    $updateQuery = "UPDATE courses SET presentation_due_date = '$presentationDue', viva_due_date = '$vivaDue', 
                    tutorial1_due_date = '$tutorial1Due', tutorial2_due_date = '$tutorial2Due' 
                    WHERE course_code = '$courseCode'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>
                alert('Probable dates updated successfully!');
                window.location.href = 'batchHome.php?courseCode=$courseCode';
              </script>";
    } else {
        echo "Error updating probable dates: " . mysqli_error($conn);
    }
} else {
    // Fetch current dates
    $datesQuery = "SELECT * FROM courses WHERE course_code = '$courseCode'";
    $datesResult = mysqli_query($conn, $datesQuery);
    $courseDetails = mysqli_fetch_assoc($datesResult);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Probable Dates</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            font-family: 'Arial', sans-serif;
            background-color: #F7F5E8
        }
        
        .container {
            margin-top: 70px;
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

        .image-container {
            text-align: center;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Image Section (col-md-6) -->
        <div class="col-md-6 mb-4 image-container">
            <img src="images/update.png" alt="Update Probable Dates" class="img-fluid rounded">
        </div>

        <!-- Form Section (col-md-6) -->
        <div class="col-md-6">
            <div class="form-container">
                <h1>Update Probable Dates for <?php echo htmlspecialchars($courseCode); ?></h1>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="presentation_due" class="form-label">Presentation Due Date:</label>
                        <input type="date" name="presentation_due" class="form-control" value="<?php echo $courseDetails['presentation_due_date']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="viva_due" class="form-label">Viva Due Date:</label>
                        <input type="date" name="viva_due" class="form-control" value="<?php echo $courseDetails['viva_due_date']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tutorial1_due" class="form-label">Tutorial 1 Due Date:</label>
                        <input type="date" name="tutorial1_due" class="form-control" value="<?php echo $courseDetails['tutorial1_due_date']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tutorial2_due" class="form-label">Tutorial 2 Due Date:</label>
                        <input type="date" name="tutorial2_due" class="form-control" value="<?php echo $courseDetails['tutorial2_due_date']; ?>" required>
                    </div>
                    <button type="submit" class="btn-update">Update Dates</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional for interactivity) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
