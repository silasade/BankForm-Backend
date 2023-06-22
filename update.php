
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles.css?v=<?php echo time(); ?>">

        <title>Update Account?</title>
    </head>
    <body>
    <?php include "./header.php" ?>

    <?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
        exit();
    }
    
    $user=$_SESSION['user'];
    
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {$firstname=$_POST['firstName'] ;
    $lastname=$_POST['lastName'];
    $email=$_POST['email'];
    
    $password=$_POST['password'];
    $copass =$_POST['confirmPass'];
    if($password==$copass){
        $conn=mysqli_connect('localhost','root');
        if($conn){
            mysqli_select_db($conn,'bank');
                $query = "SELECT * FROM registration WHERE Account_Number = '$user[Account_Number]'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    
                    $uquery = "UPDATE registration SET First_Name='$firstname' , Last_Name='$lastname', Email='$email', Password='$password', Confirm_Password='$copass'
                        WHERE Account_Number='$user[Account_Number]'";
                    $uresult=mysqli_query($conn,$uquery);
                    if($uresult){
                    echo "<h3 style='color: green;'>Updated</h3>";
                }
            }
            else{
                echo "<h3 style='color: red;'>Account does not exist</h3>";
            }
        }
        else{
            die("Connection Failed".mysqli_connect_error());
        }
        }
    }
        
    
    ?>
    
        
        <form method='POST' action='update.php' style="margin-top:2%;">    
        <h2>Update Account</h2><br>
          <label for='first-name'>First Name:</label>
          <input type='text' id='first-name' name='firstName'  required><br>
            
          <label for='last-name'>Last Name:</label>
          <input type='text' id='last-name' name='lastName' required><br>
      
          <label for='email'>Email:</label>
          <input type='email' id='email' name='email'  required><br>
      
          <label for='password'>Password:</label>
          <input type='password' id='password'  name='password' required><br>
      
          <label for='confirm-password'>Confirm Password:</label>
          <input type='password' id='confirm-password'  name='confirmPass' required><br>
            <div class='sub'>
                <input type='submit' id='submit' value='Submit'>
                
            </div>
          
        </form>
        
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    </body>
    </html>
