<?php
    $firstname=$_POST['firstName'];
    $lastname=$_POST['lastName'];
    $email=$_POST['email'];
    $account=$_POST['accountNumber'];
    $password=$_POST['password'];
    $copass =$_POST['confirmPass'];
    if(isset($firstname) && isset($lastname) && isset($email) && isset($account) && isset($password) && isset($copass)){
        if($password==$copass){
            $conn=mysqli_connect('localhost','root');
            
            if($conn){
                
                mysqli_select_db($conn,'bank');
                $iquery="SELECT * FROM registration";
                $val=false;
                $res=mysqli_query($conn,$iquery);
                while($row=mysqli_fetch_assoc($res)){
                    if($row['Account_Number']===$account){
                        $val=true;
                    }
                }
                if($val===false){
                    $query = "INSERT INTO registration (First_Name, Last_Name, Email, Account_Number, Password, Confirm_Password, Account_Balance)
                      VALUES ('$firstname', '$lastname', '$email', '$account', '$password', '$copass', 10000)";
                    $result=mysqli_query($conn,$query);
                    if($result){
                        echo "Successful";
                        header("Location: login.php");
                    }
                    else{
                        echo "failed to submit...";
                    }
                }else{
                    echo "account Number already exist\n";
                    echo "Please enter another account number";
                    header("Location: index.php");
                }
                
            }
            else{
                die("Connection Failed".mysqli_connect_error());
            }
        }
        else{
            
            echo "Password must be equal to Confirm Password";
            header("Location: index.php");
        }
    }else{
        echo "Please fill all the fields";
        header("Location: index.php");
    }
?>