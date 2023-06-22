<?php
    session_start();
    $user=$_SESSION['user'];
 $conn=mysqli_connect('localhost','root');
 mysqli_select_db($conn,'bank');
    $query="DELETE FROM registration WHERE Account_Number='$user[Account_Number]'";
    $result=mysqli_query($conn,$query);
    if($result){
        echo "Successful";
        
        header("Location: index.php");
        exit();
    }
?>