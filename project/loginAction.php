<?php

session_start();

include 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['password'], $_POST['id'])) {
   
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_POST['id']; 

    
    $query = "SELECT * FROM loginInfo WHERE email = '$email' AND id = '$id'"; 
    $result = mysqli_query($conn, $query);
    
   
if (!$result) {
   
    die("Query failed: " . mysqli_error($conn));
}


    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); 

        
        if (password_verify($password, $user['password'])) {
            // Store user info in session
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_type'] = $user['type'];
            $_SESSION['user_id']=$id; 
            
            if ($_SESSION['user_type'] == 'teacher') {
            
                $_SESSION['courseCode'] = $user['course_code']; 
                
                echo "<script>location.href='teacherHome.php'</script>";
            } else {
               
                
                
                echo "<script>location.href='studentHome.php'</script>";
            }
            exit();
        } else {
           
            echo "<script>alert('Invalid email or password!');</script>";
            echo "<script>location.href='login.php'</script>";

        }
    } else {
        
        echo "<script>alert('User not found!');</script>";

        echo "<script>location.href='login.php'</script>";
    }
} else {

    echo "<script>alert('Please fill in both email, ID, and password.');</script>";
    echo "<script>location.href='login.php'</script>";
}



?>
