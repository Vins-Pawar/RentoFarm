<?php
    session_start();
    include('database.php');
    $email=$_POST['email'];
    $name=$_POST['name'];
    $pass1=$_POST['password'];
    $pass2=$_POST['cpassword'];
    // echo $_POST['cpassword'];
    if($pass1 != $pass2)
    {
        die("password not matching");
    }

    // echo $email;
    $query="SELECT EMAIL FROM REGISTER  WHERE EMAIL='$email'";

    $result=mysqli_query($con,$query) or die(mysqli_error($con));
    if(mysqli_num_rows($result)>0){
        header("location:login.php?msg=email is already registerd");
    }
    else{
        $hashpass=password_hash($_POST['password'],PASSWORD_DEFAULT);
        // echo $hashpass;
        $query="INSERT INTO REGISTER (NAME,EMAIL,PASSWORD) VALUES ('$name','$email','$hashpass')"; 
       
        mysqli_query($con,$query) or die(mysqli_error($con));
           header("location:sendotp.php");
    }

    $_SESSION['email']=$email;
    $_SESSION['name']=$name;
    
?>