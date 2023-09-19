<?php
session_start();

// Destroy the session and redirect to the login page (you can customize the redirection)
session_destroy();

// Redirect to the login page or any other desired page
header("Location: index.php");
exit();
?>