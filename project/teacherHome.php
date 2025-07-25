<?php
// Start the session to store user info
session_start();

// Check if teacherId exists in session (indicating the teacher is logged in)
if (!isset($_SESSION['user_id'])) {
  // If teacher is not logged in, show an alert and redirect to login page
  echo "<script>
            alert('You are not logged in. Please log in first.');
            window.location.href = 'login.php'; // Replace with your actual login page URL
          </script>";
  exit;
}

include('config.php'); // Assuming this file contains your mysqli connection setup

$teacherId = $_SESSION['user_id'];

// Query to fetch courses for the logged-in teacher
$query = "SELECT DISTINCT course_code, course_name FROM courses WHERE teacher_id = '$teacherId'";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
  echo "Error fetching courses: " . mysqli_error($conn);
  exit;
}

// Count the number of unique courses
$totalCourses = mysqli_num_rows($result);

// Store the courses in an array for later use in the HTML
$courses = [];
while ($row = mysqli_fetch_assoc($result)) {
  $courses[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Budget Dashboard</title>
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
      padding: 20px;
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

    .button-group {
      display: flex;
      /* Use Flexbox to align the buttons */
      gap: 10px;
      /* Add space between buttons */
    }

    .add-course-btn {
      background-color: rgba(145, 198, 147, 0.84);
      color: #fff;
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }

    .add-course-btn:hover {
      background-color: rgb(197, 235, 229);
      transform: scale(1.05);
    }

    .main-content .header {
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
      transform: scale(1.05);
    }

    .buttons {
      background-color: rgba(145, 198, 147, 0.84);
      color: #fff;
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
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

    /* Course Cards Styling */
    .course-card {
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

    .course-card .title {
      font-size: 3rem;
      font-weight: bold;
      color: #605f4b;
    }

    .course-card .subtitle {
      font-size: 1.5rem;
      color: #ddd;
      color: #605f4b;
    }

    .course-card:hover {
      transform: scale(1.02);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="sidebar">
      <h1>Classique</h1>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="taecherHome.php">Courses</a></li>
      </ul>
    </div>

    <div class="main-content">

      <div class="header">
        <h1>Teacher Name</h1>
        <div class="button-group">
          <form action="addCourseDetails.php" method="get">
            <button type="submit" class="add-course-btn">Add More Courses</button>
          </form>
          <form action="logout.php" method="get">
            <button type="submit" class="add-course-btn">Logout</button>
          </form>
        </div>


      </div>

      <div class="wallets">
        <div class="wallet">
          <span>Total Courses</span>
          <span><?php echo $totalCourses; ?></span> <!-- Display total unique courses -->
        </div>
      </div>

      <!-- Course Cards -->
      <?php foreach ($courses as $course): ?>
        <a href="BatchHome.php?courseCode=<?php echo urlencode($course['course_code']); ?>" class="course-card">
          <div class="title"><?php echo htmlspecialchars($course['course_code']); ?></div>
          <div class="subtitle"><?php echo htmlspecialchars($course['course_name']); ?></div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>