<?php

session_start();


if (!isset($_SESSION['user_id'])) {

  echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php'; 
          </script>";
}

include('config.php');

$teacherId = $_SESSION['user_id'];
$courseCode = $_GET['courseCode'];


$courseQuery = "SELECT * FROM courses WHERE course_code = '$courseCode'";
$courseResult = mysqli_query($conn, $courseQuery);


if (!$courseResult) {

  echo "<script>alert('Error fetching course details: " . mysqli_error($conn) . "');</script>";
  echo "<script>window.history.back();</script>";
}

// course details
$courseDetails = mysqli_fetch_assoc($courseResult);

//course layout
$layoutQuery = "SELECT * FROM course_layout WHERE course_code = '$courseCode'";
$layoutResult = mysqli_query($conn, $layoutQuery);


if (!$layoutResult) {
  echo "Error fetching course layout: " . mysqli_error($conn);
  exit;
}


$courseLayout = mysqli_fetch_assoc($layoutResult);

// probable dates
$datesQuery = "SELECT * FROM courses WHERE course_code = '$courseCode'";
$datesResult = mysqli_query($conn, $datesQuery);


if (!$datesResult) {
  echo "Error fetching probable dates: " . mysqli_error($conn);
  exit;
}


$probableDates = mysqli_fetch_assoc($datesResult);

//assignments 
$assignmentsQuery = "SELECT * FROM assignments WHERE course_code = '$courseCode'";
$assignmentsResult = mysqli_query($conn, $assignmentsQuery);


if (!$assignmentsResult) {
  echo "Error fetching assignments: " . mysqli_error($conn);
  exit;
}


$query = "SELECT * FROM course_batches WHERE course_code = '$courseCode'";
$result = mysqli_query($conn, $query);


if (!$result) {
  echo "Error fetching batches: " . mysqli_error($conn);
  exit;
}


$batches = [];
while ($row = mysqli_fetch_assoc($result)) {
  $batches[] = $row;
}

// Fetch resources
$resourcesQuery = "SELECT * FROM resources WHERE course_code = '$courseCode'";
$resourcesResult = mysqli_query($conn, $resourcesQuery);


if (!$resourcesResult) {
  echo "Error fetching resources: " . mysqli_error($conn);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Batches for <?php echo htmlspecialchars($courseCode); ?></title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f8f8fb;
      color: #333;
    }

    .container {
      display: flex;
      flex-direction: row;
      background-color: #F7F5E8 padding: 20px;
    }

    .sidebar {
      width: 240px;
      background-color: #ffffff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .sidebar h1 {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin-bottom: 15px;
    }

    .sidebar ul li a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .main-content {
      flex-grow: 1;
      margin-left: 20px;
      background-color: #ffffff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .header h1 {
      font-size: 20px;
      font-weight: bold;
    }

    .header .add-course-btn {
      background-color: rgba(145, 198, 147, 0.84);
      color: #fff;
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }

    .header .add-course-btn:hover {
      background-color: rgb(197, 235, 229);
    }

    .wallets {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    .wallet {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 12px;
      font-size: 18px;
      padding: 15px;
      background-color: #f1f1f1;
      border-radius: 10px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Batch Cards Styling */
    .batch-card {
      background-color: #f1f1f1;
      background-image: url('images/TEACHER_card.png');
      /* Add a background image */
      background-size: cover;
      background-position: center;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 150px;
      color: white;
    }

    .batch-card:hover {
      background-color: #c5e1f7;
    }

    .batch-name {
      font-size: 2.5rem;
      font-weight: bold;
      color: #605f4b;
    }

    .section {
      font-size: 1.5rem;
      margin-top: 5px;
      color: #605f4b;
    }

    .table-container {
      width: 100%;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      margin-top: 10px;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f1f1f1;
    }



    .course-info {
      flex-grow: 1;
      /* Takes up remaining space to push buttons to the right */
    }

    .buttons {
      display: flex;
      gap: 10px;
    }

    .buttons button {
      padding: 6px 12px;
      background-color: #6f93e4;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .buttons button:hover {
      background-color: #5a80c7;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="sidebar">
      <h1>Classique</h1>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="teacherHome.php">Courses</a></li>
      </ul>
    </div>

    <div class="main-content">
      <div class="header">
        <h1>Batches for <?php echo htmlspecialchars($courseCode); ?></h1>
      </div>

      <!-- Course Title and Code -->
      <div class="table-container">
        <h2>Course Title: <?php echo htmlspecialchars($courseDetails['course_name']); ?></h2>
        <h3>Course Code: <?php echo htmlspecialchars($courseCode); ?></h3>
        <div class="buttons">
          <button onclick="location.href='update_course.php?courseCode=<?php echo $courseCode; ?>'">Update</button>
          <button onclick="location.href='delete_course.php?courseCode=<?php echo $courseCode; ?>'">Delete</button>
        </div>
      </div>

      <!-- Course Layout -->
      <div class="table-container">
        <h2>Course Layout</h2>
        <div class="buttons">
          <button onclick="location.href='update_layout.php?courseCode=<?php echo $courseCode; ?>'">Update</button>
          <button onclick="location.href='delete_layout.php?courseCode=<?php echo $courseCode; ?>'">Delete</button>
        </div>
        <table>
          <tr>
            <th>Exam Type</th>
            <th>Marks</th>
          </tr>
          <tr>
            <td>Mid Exam</td>
            <td><?php echo htmlspecialchars($courseLayout['mid_exam_marks']); ?></td>
          </tr>
          <tr>
            <td>Final Exam</td>
            <td><?php echo htmlspecialchars($courseLayout['final_exam_marks']); ?></td>
          </tr>
          <tr>
            <td>Attendance</td>
            <td><?php echo htmlspecialchars($courseLayout['attendance_marks']); ?></td>
          </tr>
          <tr>
            <td>Assignment</td>
            <td><?php echo htmlspecialchars($courseLayout['assignment_marks']); ?></td>
          </tr>
          <tr>
            <td>Viva</td>
            <td><?php echo htmlspecialchars($courseLayout['viva_marks']); ?></td>
          </tr>
          <tr>
            <td>Presentation</td>
            <td><?php echo htmlspecialchars($courseLayout['presentation_marks']); ?></td>
          </tr>
          <tr>
            <td>Tutorial</td>
            <td><?php echo htmlspecialchars($courseLayout['tutorial_marks']); ?></td>
          </tr>
        </table>
      </div>

      <!-- Probable Dates -->
      <div class="table-container">
        <h2>Probable Dates</h2>
        <div class="buttons">
          <button onclick="location.href='update_dates.php?courseCode=<?php echo $courseCode; ?>'">Update</button>
          <button onclick="location.href='delete_dates.php?courseCode=<?php echo $courseCode; ?>'">Delete</button>
        </div>
        <table>
          <tr>
            <th>Presentation Due</th>
            <th>Viva Due</th>
            <th>Tutorial 1 Due</th>
            <th>Tutorial 2 Due</th>
          </tr>
          <tr>
            <td><?php echo htmlspecialchars($courseDetails['presentation_due_date']); ?></td>
            <td><?php echo htmlspecialchars($courseDetails['viva_due_date']); ?></td>
            <td><?php echo htmlspecialchars($courseDetails['tutorial1_due_date']); ?></td>
            <td><?php echo htmlspecialchars($courseDetails['tutorial2_due_date']); ?></td>
          </tr>
        </table>
      </div>

      <!-- Assignments -->
      <div class="table-container">
        <h2>Assignments</h2>
        <div class="buttons">
          <button onclick="location.href='update_assignment.php?courseCode=<?php echo $courseCode; ?>'">Update</button>
          <button onclick="location.href='delete_assignment.php?courseCode=<?php echo $courseCode; ?>'">Delete</button>
        </div>
        <table>
          <tr>
            <th>Assignment Title</th>
            <th>Due Date</th>
          </tr>
          <?php while ($assignment = mysqli_fetch_assoc($assignmentsResult)): ?>
            <tr>
              <td><?php echo htmlspecialchars($assignment['assignment_title']); ?></td>
              <td><?php echo htmlspecialchars($assignment['due_date']); ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>

      <!-- Resources -->
      <div class="table-container">
        <h2>Resources</h2>
        <div class="buttons">
          <button onclick="location.href='update_resource.php?courseCode=<?php echo $courseCode; ?>'">Update</button>
          <button onclick="location.href='delete_resource.php?courseCode=<?php echo $courseCode; ?>'">Delete</button>
        </div>
        <table>
          <tr>
            <th>Resource Link</th>
          </tr>
          <?php while ($resource = mysqli_fetch_assoc($resourcesResult)): ?>
            <tr>
              <td><a href="<?php echo htmlspecialchars($resource['resource_link']); ?>"
                  target="_blank"><?php echo htmlspecialchars($resource['resource_link']); ?></a></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>

      <!-- Batches -->
      <div class="wallets">
        <div class="wallet">
          <span>Total Batches</span>
          <span><?php echo count($batches); ?></span> <!-- Display total batches -->
        </div>
      </div>

      <!-- Loop through batches and display them as cards -->
      <?php foreach ($batches as $batch): ?>
        <a href="batch_info.php?course_code=<?php echo urlencode($courseCode); ?>&batch_name=<?php echo urlencode($batch['batch_name']); ?>&section=<?php echo urlencode($batch['section']); ?>"
          class="batch-card">
          <div class="batch-name"><?php echo htmlspecialchars($batch['batch_name']); ?></div>
          <div class="section"><?php echo htmlspecialchars($batch['section']); ?></div>
        </a>
      <?php endforeach; ?>
    </div>

  </div>
</body>

</html>