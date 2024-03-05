<?php
    $host="localhost";
    $user="root";
    $pass="";

    $con=mysqli_connect($host,$user,$pass) or die(mysqli_error($con));
    // mysqli_query($con,"drop database verifyemail");
    mysqli_select_db($con,"RENTOFARM");

?>