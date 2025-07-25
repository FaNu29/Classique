<?php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $batchName = $_POST['batchName'];
    $section = $_POST['section'];

    $courseCode = $_SESSION['courseCode'];

    
    $query = "INSERT INTO course_batches (course_code, batch_name, section) VALUES ('$courseCode', '$batchName', '$section')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert(' Batch Saved');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        echo "<script>alert('Failed to save course: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.history.back();</script>";
    }
}

// Fetch all batches for the course
$courseCode = $_SESSION['courseCode'];
$query = "SELECT * FROM course_batches WHERE course_code = '$courseCode'";
$result = mysqli_query($conn, $query);
$batches = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .container-fluid {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }

        h2,
        h3,
        h4,
        h5 {
            font-weight: bold;
            color: #333;
        }

        .btn,
        .form-control {
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
        }

        .sidebar {
            width: 280px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar h1 {
            font-size: 2rem;
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

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .container-fluid {
                padding: 20px;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
            }

            .sidebar h1 {
                text-align: center;
            }

            .col-md-10 {
                width: 100%;
            }

            .btn {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-4 nav-side-bar">
                <h4 class="text-center">Classique</h4>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="teacherHome.php" class="nav-link">My courses</a></li>
                   
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <!-- Course Information Form -->
                <div class="mb-4">
                    <h3>Course Information</h3>
                    <form id="courseForm" action="addCourseAction.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="courseCode">Course Code:</label>
                                <input type="text" id="courseCode" name="courseCode" class="form-control"
                                    placeholder="Enter course code">
                            </div>
                            <div class="col-md-6">
                                <label for="courseName">Course Name:</label>
                                <input type="text" id="courseName" name="courseName" class="form-control"
                                    placeholder="Enter course name">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Course Info</button>
                    </form>
                </div>

                <!-- Batches Section -->
                <!-- Display message if any -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-info">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Form to add batch -->
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="batchName" class="form-label">Batch Name</label>
                        <input type="text" id="batchName" name="batchName" class="form-control"
                            placeholder="Enter batch name" required>
                    </div>
                    <div class="mb-3">
                        <label for="section" class="form-label">Section</label>
                        <input type="text" id="section" name="section" class="form-control" placeholder="Enter section"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success">Save Batch</button>
                </form>

                <h5 class="mt-4">Added Batches</h5>
                <ul class="list-group">
                    <?php foreach ($batches as $batch): ?>
                        <li class="list-group-item">
                            <strong><?php echo htmlspecialchars($batch['batch_name']); ?></strong> (Section:
                            <?php echo htmlspecialchars($batch['section']); ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Right-Aligned Sections -->
            <div class="col-md-10 offset-md-2">
                <!-- Probable Dates Section (Presentation) -->
                <div class="mb-4">
                    <h5>Probable Dates for Presentation</h5>
                    <form id="presentationForm" action="addPresentationAction.php" method="post">
                        <div class="mb-3">
                            <label for="presentationDate">Presentation Date:</label>
                            <input type="date" id="presentationDate" name="presentationDate" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </form>
                </div>

                <!-- Probable Dates Section (Viva) -->
                <div class="mb-4">
                    <h5>Probable Dates for Viva</h5>
                    <form id="vivaForm" action="addVivaAction.php" method="post">
                        <div class="mb-3">
                            <label for="vivaDate">Viva Date:</label>
                            <input type="date" id="vivaDate" name="vivaDate" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </form>
                </div>

                <!-- Probable Tutorials Section -->
                <div class="mb-4">
                    <h5>Probable Dates for Tutorials</h5>
                    <form id="tutorialForm" action="addTutorialDates.php" method="post">
                        <div class="mb-3">
                            <label for="tutorial1Date">Tutorial 1 Date:</label>
                            <input type="date" id="tutorial1Date" name="tutorial1Date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tutorial2Date">Tutorial 2 Date:</label>
                            <input type="date" id="tutorial2Date" name="tutorial2Date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>

                <!-- Course Layout Section -->
                <div class="mb-4">
                    <h5>Course Layout</h5>
                    <form id="courseLayoutForm" action="courseLayoutAction.php" method="post">
                        <div class="mb-3">
                            <label for="midExamMarks">Mid Exam Marks:</label>
                            <input type="number" id="midExamMarks" name="midExamMarks" class="form-control"
                                oninput="updateTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="finalExamMarks">Final Exam Marks:</label>
                            <input type="number" id="finalExamMarks" name="finalExamMarks" class="form-control"
                                oninput="updateTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="attendanceMarks">Attendance Marks:</label>
                            <input type="number" id="attendanceMarks" name="attendanceMarks" class="form-control"
                                oninput="updateTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="assignmentMarks">Assignments Marks:</label>
                            <input type="number" id="assignmentMarks" name="assignmentMarks" class="form-control"
                                oninput="updateTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="vivaMarks">Viva Marks:</label>
                            <input type="number" id="vivaMarks" name="vivaMarks" class="form-control"
                                oninput="updateTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="tutorialMarks">Tutorial Marks:</label>
                            <input type="number" id="tutorialMarks" name="tutorialMarks" class="form-control"
                                oninput="updateTotal()">
                        </div>

                        <div class="mb-3">
                            <label for="presentationMarks">Presentations Marks:</label>
                            <input type="number" id="presentationMarks" name="presentationMarks" class="form-control"
                                oninput="updateTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="totalMarks">Total Marks:</label>
                            <input type="text" id="totalMarks" class="form-control" readonly>
                        </div>

                        <!-- Save Button -->
                        <button type="submit" class="btn btn-primary">Save Course Layout</button>
                    </form>
                </div>

                <!-- Resources Section -->
                <div class="mb-4">
                    <h5>Resources</h5>
                    <form id="resourceForm" action="resourceAction.php" method="post">
                        <div class="mb-3">
                            <label for="resourceLink">Add Google Drive Link:</label>
                            <input type="url" id="resourceLink" class="form-control" name="resourceLink"
                                placeholder="Enter Google Drive link">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Add Resource</button>
                    </form>
                </div>

                <!-- Assignments Section -->
                <div class="mb-4">
                    <h5>Assignments</h5>
                    <form id="assignment1Form" action="saveAssignment.php" method="post">
                        <div class="mb-3">
                            <label for="assignmentTitle">Assignment 1 Title:</label>
                            <input type="text" id="assignmentTitle" name="assignmentTitle" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="assignmentDesc">Assignment 1 Description:</label>
                            <textarea id="assignmentDesc" name="assignmentDesc" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="assignmentDue">Assignment 1 Due Date:</label>
                            <input type="date" id="assignmentDue" name="assignmentDue" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Save Assignment 1</button>
                    </form>

                    <form id="assignment2Form" action="saveAssignment.php" method="post" class="mt-4">
                        <div class="mb-3">
                            <label for="assignmentTitle">Assignment 2 Title:</label>
                            <input type="text" id="assignmentTitle" name="assignmentTitle" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="assignmentDesc">Assignment 2 Description:</label>
                            <textarea id="assignmentDesc" name="assignmentDesc" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="assignmentDue">Assignment 2 Due Date:</label>
                            <input type="date" id="assignmentDue" name="assignmentDue" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Save Assignment 2</button>
                    </form>

                </div>
                <form action="teacherHome.php" method="get">
            <button type="submit" class="add-course-btn">Done</button>
          </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateTotal() {
            let midExamMarks = parseInt(document.getElementById("midExamMarks").value) || 0;
            let finalExamMarks = parseInt(document.getElementById("finalExamMarks").value) || 0;
            let attendanceMarks = parseInt(document.getElementById("attendanceMarks").value) || 0;
            let assignmentMarks = parseInt(document.getElementById("assignmentMarks").value) || 0;
            let vivaMarks = parseInt(document.getElementById("vivaMarks").value) || 0;
            let tutorialMarks = parseInt(document.getElementById("tutorialMarks").value) || 0;
            let presentationMarks = parseInt(document.getElementById("presentationMarks").value) || 0;

            let totalMarks = midExamMarks + finalExamMarks + attendanceMarks + assignmentMarks + vivaMarks + tutorialMarks + presentationMarks;
            document.getElementById("totalMarks").value = totalMarks;
        }
    </script>
</body>

</html>
