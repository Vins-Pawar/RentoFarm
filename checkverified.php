<?php
    include('database.php');
    session_start();

    $email=$_POST['email'];
    $pass=$_POST['password'];
    $_SESSION['email']=$email;

    $query="select * from register where email='$email'";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($result)>0){

        while($row = mysqli_fetch_array($result)) {
            $userid=$row['USERID'];
            $verified=$row["VERIFYEMAIL"];
            $hashpass=$row["PASSWORD"]; 
        }
         $passmatch=password_verify($pass,$hashpass);
         if($passmatch)
         {
             if($verified==1)
             {
                $_SESSION['user']= $userid;
                header("location:userDashboard.php?msg=login successful");
             }
             else{
                header("location:sendotp.php");
             }
         }
         else
         {
            // echo"wrong password";
            header("location:login.php?msg=Incorrect Email or Password");
         }
          
        
    }
    else
    {
        header("location:login.php?msg=Incorrect Email or Password");
    }
?>