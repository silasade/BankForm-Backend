<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css?v=<?php echo time(); ?>">

    <title>Document</title>
</head>

<body style="margin: 0;">
<?php include "./header.php" ?>


    <?php
    
    session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['user'])) {
        // Redirect to login.php 
        header("Location: login.php");
        exit();
    }

    $user = $_SESSION['user'];
    echo "<div class='details'>";
    echo '<h3>Name: ' . $user['First_Name'] . " " . $user['Last_Name'] . '</h3>';
    echo '<h3>Email: ' . $user['Email'] . '</h3>';
    echo '<h3>Account Number: ' . $user['Account_Number'] . '</h3>';
    echo '<h3>Account Balance: $' . $user['Account_Balance'] . '</h3>';
    echo "You sent this money!!";
    echo "<button class='delete'><a 'class=delete1' href='./delete.php'>Delete Account</a></button>";
    echo "</div>"
    ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>
