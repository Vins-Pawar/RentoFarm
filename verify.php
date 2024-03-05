<?php
    include('database.php');
    session_start();
    // echo $_POST['otp']."<br>";
    // echo $_SESSION['otp']."<br>";
    $email=$_SESSION['email'];
    if(isset($_POST['otp']))
    {
        $userOtp=$_REQUEST['otp'];
        // $otp=$_COOKIE['otp'];
        $otp=$_SESSION['otp'];

        if( $userOtp==$otp)
        {
            $query="update register set verifyemail=1 where email='$email'";
            mysqli_query($con,$query);
            header('location:html/project.html?msg=welcome to dashboard');
        }
        else{
            // echo $userOtp."<br>";
            // echo $otp;
            header('location:userotp.php?msg=wrong otp');
        }
    }
?>