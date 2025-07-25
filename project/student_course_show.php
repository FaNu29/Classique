<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    
    echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php'; // Replace with your actual login page URL
          </script>";
    exit;
}

include('config.php'); 

$studentId = $_SESSION['user_id']; 
$courseCode = $_GET['course_code']; 

// Query to fetch course details
$courseQuery = "SELECT * FROM courses WHERE course_code = '$courseCode'";
$courseResult = mysqli_query($conn, $courseQuery);


if (!$courseResult) {
    echo "Error fetching course details: " . mysqli_error($conn);
    exit;
}

// Fetch the course details
$courseDetails = mysqli_fetch_assoc($courseResult);

// Query to fetch teacher's information from the teacher table using teacher_id from the courses table
$teacherQuery = "SELECT `name` FROM teacher WHERE teacher_id = '" . $courseDetails['teacher_id'] . "'";
$teacherResult = mysqli_query($conn, $teacherQuery);


if (!$teacherResult) {
    echo "Error fetching teacher information: " . mysqli_error($conn);
    exit;
}


$teacher = mysqli_fetch_assoc($teacherResult);

// Query to fetch course layout from the course_layout table
$layoutQuery = "SELECT * FROM course_layout WHERE course_code = '$courseCode'";
$layoutResult = mysqli_query($conn, $layoutQuery);

if (!$layoutResult) {
    echo "Error fetching course layout: " . mysqli_error($conn);
    exit;
}


$courseLayout = mysqli_fetch_assoc($layoutResult);

// Query to fetch probable dates from the courses table
$datesQuery = "SELECT * FROM courses WHERE course_code = '$courseCode'";
$datesResult = mysqli_query($conn, $datesQuery);


if (!$datesResult) {
    echo "Error fetching probable dates: " . mysqli_error($conn);
    exit;
}


$probableDates = mysqli_fetch_assoc($datesResult);

// Query to fetch assignments from the assignments table
$assignmentsQuery = "SELECT * FROM assignments WHERE course_code = '$courseCode'";
$assignmentsResult = mysqli_query($conn, $assignmentsQuery);


if (!$assignmentsResult) {
    echo "Error fetching assignments: " . mysqli_error($conn);
    exit;
}


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
  <title>Course Information for <?php echo htmlspecialchars($courseCode); ?></title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f4f7fb;
      color: #333;
    }

    .container {
      display: flex;
      flex-direction: row;
      padding: 30px;
      justify-content: space-between;
    }

    .sidebar {
      width: 240px;
      background-color: #ffffff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar h1 {
      font-size: 20px;
      font-weight: bold;
      color: #0077cc;
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
      transition: color 0.3s;
    }

    .sidebar ul li a:hover {
      color: #0077cc;
    }

    .main-content {
      flex-grow: 1;
      margin-left: 20px;
      background-color: #ffffff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      padding-bottom: 10px;
      border-bottom: 2px solid #e0e0e0;
    }

    .header h1 {
      font-size: 24px;
      font-weight: bold;
      color: #0077cc;
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

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #f1f1f1;
      font-size: 16px;
      color: #0077cc;
    }

    td {
      font-size: 14px;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f0f0f0;
    }

    .button {
      background-color: #0077cc;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .button:hover {
      background-color: #005f99;
    }

    .footer {
      text-align: center;
      margin-top: 50px;
      font-size: 14px;
      color: #888;
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
        <h1>Course Information for <?php echo htmlspecialchars($courseCode); ?></h1>
      </div>

      <!-- Course Title and Code -->
      <div class="table-container">
        <h2>Course Title: <?php echo htmlspecialchars($courseDetails['course_name']); ?></h2>
        <h3>Course Code: <?php echo htmlspecialchars($courseCode); ?></h3>
      </div>

      <!-- Teacher Information -->
      <div class="table-container">
        <h2>Teacher Information</h2>
        <table>
          <tr>
            <th>Teacher ID</th>
            <td><?php echo htmlspecialchars($courseDetails['teacher_id']); ?></td>
          </tr>
          <tr>
            <th>Teacher Name</th>
            <td><?php echo htmlspecialchars($teacher['name']); ?></td> <!-- Display teacher's name -->
          </tr>
        </table>
      </div>

      <!-- Course Layout -->
      <div class="table-container">
        <h2>Course Layout</h2>
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
        <table>
          <tr>
            <th>Resource Link</th>
          </tr>
          <?php while ($resource = mysqli_fetch_assoc($resourcesResult)): ?>
            <tr>
              <td><a href="<?php echo htmlspecialchars($resource['resource_link']); ?>" target="_blank"><?php echo htmlspecialchars($resource['resource_link']); ?></a></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
    </div>
  </div>

  <div class="footer">
    <p>&copy; 2025 Your University. All rights reserved.</p>
  </div>
</body>
</html>
