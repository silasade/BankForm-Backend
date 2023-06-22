<?php 
session_start();


if (isset($_SESSION['user'])) {
    // Redirect to login.php 
    
    header("Location: login.php");
    exit();
}

?>