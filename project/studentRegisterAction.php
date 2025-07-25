<?php
session_start();    
include 'config.php';


$student_name = $_POST['student-name'];
$student_id = $_POST['student-id'];
$student_email = $_POST['student-email'];
$student_password = $_POST['student-password'];
$student_batch = $_POST['student-batch'];
$cr_status = isset($_POST['cr-status']) ? 1 : 0 ;


// Define regex patterns
$emailPattern = "/(cse)_\d{10}@lus\.ac\.bd/"; 
$passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; 

// Validate inputs
if (strlen($student_name) < 3 || strlen($student_name) > 50) {
    echo "<script>alert('Name should be between 3 and 50 characters.');</script>";
    echo "<script>location.href='studentRegister.php'</script>";
    exit();
} elseif (!preg_match($emailPattern, $student_email)) {
    echo "<script>alert('Invalid email format!');</script>";
    echo "<script>location.href='studentRegister.php'</script>";
    exit();
} elseif (!preg_match($passwordPattern, $student_password)) {
    echo "<script>alert('Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.');</script>";
    echo "<script>location.href='studentRegister.php'</script>";
    exit();
}

// Check if email or student ID already exists
$duplicate_check_query = "SELECT * FROM `student` WHERE email = '$student_email' OR student_id = '$student_id'";
$duplicate_check_result = mysqli_query($conn, $duplicate_check_query);

if (mysqli_num_rows($duplicate_check_result) > 0) {
    echo "<script>alert('Email or Student ID already taken!');</script>";
    echo "<script>location.href='studentRegister.php'</script>";
    exit();
}

// Hash the password before storing it
$hashed_password = password_hash($student_password, PASSWORD_DEFAULT);

// Prepare the insert query
$insert_query = "INSERT INTO `student` ( `student_id`, `name`, `email`, `password`, `batch` ,`cr`) VALUES ( '$student_id', '$student_name',  '$student_email', '$hashed_password', '$student_batch', '$cr_status')";

// Execute the insert query
if (!mysqli_query($conn, $insert_query)) {
    echo "<script>alert('An error occurred during registration. Please try again.');</script>";
    echo "<script>location.href='studentRegister.php'</script>";
    exit();
} else {
    echo "<script>alert('Registration successful!');</script>";
    echo "<script>location.href='login.php'</script>";
}

$insert_login_query = "INSERT INTO `loginInfo` (`id`, `email`, `password`, `type`) VALUES ('$student_id', '$student_email', '$hashed_password', 'student')";

// Insert into the `loginInfo` table
if (!mysqli_query($conn, $insert_login_query)) {
    echo "<script>alert('An error occurred during login info registration. Please try again.');</script>";
    echo "<script>location.href='studentRegister.php'</script>";
    exit();
} else {
    echo "<script>alert('Registration successful!');</script>";
    echo "<script>location.href='login.php'</script>";
}

// Close the database connection
mysqli_close($conn);
?>
