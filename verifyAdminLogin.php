<?php
    include('database.php');
    session_start();

    $email=$_POST['email'];
    $pass=$_POST['password'];
    $_SESSION['email']=$email;

    $query="select * from adminLogin where email='$email'";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($result)>0){

        while($row = mysqli_fetch_array($result)) {

            $hashpass=$row[1]; 
        }
         
        //  $passmatch=password_verify($pass,$hashpass);
      echo $pass+" "+$hashpass;

         if($pass==$hashpass)
         {
                header("location:adminDashboard.php?msg=login successful");
              
         }
         else
         {
            // echo"wrong password";
            header("location:adminlogin.php?msg=Incorrect Email or Password");
         }
          
        
    }
    else
    {
        header("location:adminlogin.php?msg=Incorrect Email or Password");
    }
?>