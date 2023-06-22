<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css?v=<?php echo time(); ?>">

    <title>Send Money</title>
</head>
<body>
 <?php include "./header.php" ?>

<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login.php 
    
    header("Location: login.php");
    exit();
}
$user=$_SESSION['user'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $account = $_POST['accountNumber'];
    $number = $_POST['amount'];

    if (isset($account) && isset($number)) {
         $conn=mysqli_connect('localhost','root');
        if (!$conn) {
            die("Connection Failed: " . mysqli_connect_error());
        } else {
            mysqli_select_db($conn,'bank');
            $query = "SELECT * FROM registration WHERE Account_Number = '$account'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
                $accountBalance = $row['Account_Balance'];
                $newAccountBalance = $accountBalance + $number;
                if ($account!=$user['Account_Number'])
                {
                    $user['Account_Balance']=$user['Account_Balance']-$number;
                    $updateQuery = "UPDATE registration SET Account_Balance = '$newAccountBalance' WHERE Account_Number = '$account'";
                    $updateResult = mysqli_query($conn, $updateQuery);
                    $updateQuery1 = "UPDATE registration SET Account_Balance = '$user[Account_Balance]' WHERE Account_Number = '$user[Account_Number]'";
                    $updateResult1 = mysqli_query($conn, $updateQuery1);
                    
                    if ($updateResult && $updateResult1) {
                        echo "<h3 style='color: green;'>Transaction successful</h3>";
                        $time=time();
                        $_SESSION['time']=$time;
                        echo $time;
                    } else {
                        echo "<h3 style='color: red;'>Transaction failed</h3>";
                        
                    }
            
            }
            else{
                echo "<h3 style='color: red;'>Invalid Account Number</h3>";
            }
            } else {
                echo "<h3 style='color: red;'>Invalid Account Number</h3>";
            }
        }
    }
}
?>
    
    
<form method="POST" action="transactions.php" style="margin-top: 7%;">
<marquee behavior="" direction="">
        
        <?php 
        $count=0;
        $conn=mysqli_connect('localhost','root');
        if (!$conn) {
            die("Connection Failed: " . mysqli_connect_error());
        } else {
            mysqli_select_db($conn,'bank');

            $query = "SELECT * FROM registration";
            $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
                $count=$count+1;
                echo 'Account number'.' '.$count. ':'.' ';
                echo $row['Account_Number'].' '.' |'.' ';
                }}  ?></marquee>
    <h2>Send money</h2><br>

    <label for="account-number">Account Number to send:</label>
    <input type="text" id="account-number" name="accountNumber" required><br><br>
    <label for="amount">Amount to send:</label>
    <input type="number" id="amount" name="amount" required><br><br>

    <div class="sub" style="display: flex; flex-direction: row; justify-content: center;">
        <input type="submit" id="submit" value="Send" style="width:100%;padding: 5% 10% 5% 10%;">
    </div>
</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>
