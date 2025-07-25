<?php
session_start();

include 'config.php';


$teacher_name = $_POST['teacher-name'];
$teacher_id = $_POST['teacher-id'];
$teacher_email = $_POST['teacher-email'];
$teacher_password = $_POST['teacher-password'];
$routine_file = isset($_FILES['routine']) ? $_FILES['routine'] : null;
$offdays = $_POST['offdays'];

// Define regex patterns
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; 
$passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; // Password validation

// Validate inputs
if (strlen($teacher_name) < 3 || strlen($teacher_name) > 50) {
    echo "<script>alert('Name should be between 3 and 50 characters.');</script>";
    echo "<script>location.href='teacherRegister.php'</script>";
    exit();
} elseif (!preg_match($emailPattern, $teacher_email)) {
    echo "<script>alert('Invalid email format!');</script>";
    echo "<script>location.href='teacherRegister.php'</script>";
    exit();
} elseif (!preg_match($passwordPattern, $teacher_password)) {
    echo "<script>alert('Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.');</script>";
    echo "<script>location.href='teacherRegister.php'</script>";
    exit();
}

// Check if email or teacher ID already exists
$duplicate_check_query = "SELECT * FROM `teacher` WHERE email = '$teacher_email' OR teacher_id = '$teacher_id'";
$duplicate_check_result = mysqli_query($conn, $duplicate_check_query);

if (mysqli_num_rows($duplicate_check_result) > 0) {
    echo "<script>alert('Email or Teacher ID already taken!');</script>";
    echo "<script>location.href='teacherRegister.php'</script>";
    exit();
}

// Hash the password before storing it
$hashed_password = password_hash($teacher_password, PASSWORD_DEFAULT);

// Handle file upload (routine)
$routine_path = null;
if ($routine_file && $routine_file['error'] === 0) {
    // Check for file type and size
    $target_dir = "uploads/routines/";
    $target_file = $target_dir . basename($routine_file["name"]);
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, the file already exists.');</script>";
        echo "<script>location.href='teacherRegister.php'</script>";
        exit();
    }

    // Check file size ( limit to 5MB)
    if ($routine_file["size"] > 5 * 1024 * 1024) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        echo "<script>location.href='teacherRegister.php'</script>";
        exit();
    }

    // Allow only certain file formats (optional)
    $allowed_file_types = ["pdf", "docx", "xlsx"];
    $file_extension = pathinfo($routine_file["name"], PATHINFO_EXTENSION);
    if (!in_array(strtolower($file_extension), $allowed_file_types)) {
        echo "<script>alert('Sorry, only PDF, DOCX, and XLSX files are allowed.');</script>";
        echo "<script>location.href='teacherRegister.php'</script>";
        exit();
    }

    // Attempt to move the uploaded file
    if (move_uploaded_file($routine_file["tmp_name"], $target_file)) {
        $routine_path = $target_file;
    } else {
        echo "<script>alert('Sorry, there was an error uploading your routine file.');</script>";
        echo "<script>location.href='teacherRegister.php'</script>";
        exit();
    }
} else {
    echo "<script>alert('No file uploaded or there was an error with the file upload.');</script>";
    echo "<script>location.href='teacherRegister.php'</script>";
    exit();
}

// Prepare the insert query for the `teacher` table
$insert_teacher_query = "INSERT INTO `teacher` (`teacher_id`, `name`, `email`, `password`, `routine`, `offday`) 
                         VALUES ('$teacher_id', '$teacher_name', '$teacher_email', '$hashed_password', '$routine_path', '$offdays')";

// Insert into the `teacher` table
if (!mysqli_query($conn, $insert_teacher_query)) {
    echo "<script>alert('An error occurred during teacher registration. Please try again.');</script>";
    echo "<script>location.href='teacherRegister.php'</script>";
    exit();
}

// Prepare the insert query for the `loginInfo` table
$insert_login_query = "INSERT INTO `loginInfo` (`id`, `email`, `password`, `type`) 
                       VALUES ('$teacher_id', '$teacher_email', '$hashed_password', 'teacher')";

// Insert into the `loginInfo` table
if (!mysqli_query($conn, $insert_login_query)) {
    echo "<script>alert('An error occurred during login info registration. Please try again.');</script>";
    echo "<script>location.href='teacherRegister.php'</script>";
    exit();
} else {
    echo "<script>alert('Registration successful!');</script>";
    echo "<script>location.href='login.php'</script>";
}

// Close the database connection
mysqli_close($conn);
?>
