<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">

    <title>Login</title>
</head>
<body>
<?php
session_start();



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $account = $_POST['accountNumber'];
    $pass = $_POST['password'];

    if (isset($pass) && isset($account)) {
         $conn=mysqli_connect('localhost','root');

        if (!$conn) {
            die("Failed to connect: " . mysqli_connect_error());
        } else {
            mysqli_select_db($conn, 'bank');
            $query = "SELECT * FROM registration";
            $result = mysqli_query($conn, $query);

            $authenticated = false; // Flag to check if the account is authenticated

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['Account_Number'] == $account && $row['Password'] == $pass) {
                    $authenticated = true;

                    // Store the user information in the session
                    $_SESSION['user'] = $row;

                    // Redirect to details.php 
                    
                    
                            header("Location: details.php");

                    exit();
                }
            }

            if (!$authenticated) {
                echo "Invalid account number or password";
                
            }
        }
    }
}
?>

<form method="POST" action="login.php" style="margin-top: 7%;">
    <h2>Login</h2>

    <label for="account-number">Account Number:</label>
    <input type="text" id="account-number" name="accountNumber" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <div class="sub" style="display: flex; flex-direction: row; justify-content: center;">
        <input type="submit" id="submit" value="Login" style="padding: -1px 10px 2px 10px;">
        <button class="create">
            <a href="./index.php">Create Account</a>
        </button>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>
