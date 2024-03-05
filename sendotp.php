<?php
session_start();
include('database.php');
include('mailer.php');
// session_start();
// header('location:database.php');

$email=$_SESSION['email'];
$query="select * from register where email='$email'";
$result=mysqli_query($con,$query) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0){
    // echo"record found";
    $otp=rand(11111,99999);
    // echo $otp;

    sendEmail($email,"RntoFarm login OTP",$otp);
    // $query="update user set otp='$otp' where email='$email'";
    // mysqli_query($con,$query);
    // setcookie('otp',$otp);
    $_SESSION['otp']=$otp;
    header('Location:userotp.php?msg=check ur email for otp & verify..!');
}
else
    header('Location:login.php?msg=verification failed');
    // echo"record not found";
?>