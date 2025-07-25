<?php

session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();


echo "<script>
        alert('You have been logged out successfully.');
        window.location.href = 'login.php'; // Replace with your actual login page URL
      </script>";
exit;
?>
