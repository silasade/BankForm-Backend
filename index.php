<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time();?>">

    <title>Create</title>
</head>
<body>


    <form method="POST" action="connect.php">    
        <h2>Create Account</h2>
      <label for="first-name">First Name:</label>
      <input type="text" id="first-name" name="firstName" required><br>
        
      <label for="last-name">Last Name:</label>
      <input type="text" id="last-name" name="lastName" required><br>
  
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br>
  
      <label for="account-number">Account Number:</label>
      <input type="text" id="account-number" name="accountNumber" required><br>
  
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br>
  
      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm-password" name="confirmPass" required><br>
        <div class="sub">
            <input type="submit" id="submit" value="Submit">
            <h3><a  href="./login.php">already have an account? Login</a></h3>
        </div>
      
    </form>
</div>
</body>
</html>