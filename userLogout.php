<?php
session_start();

 
$_SESSION = array();

// Destroy the session
session_destroy();

header("location: login.php?msg=Logout successful");
exit;
?>
