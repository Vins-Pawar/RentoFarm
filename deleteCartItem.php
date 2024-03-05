<?php
session_start();
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];
    $userId = $_SESSION['user'];
    
    
    $deleteQuery = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
    $statement = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($statement, "ii", $itemId, $userId);
    
    if (mysqli_stmt_execute($statement)) {
         
        header("location:cart.php?msg=Item deleted successfully.");
        exit();
    } else {
         
        header("location:cart.php?msg=Something went wrong.");
        exit();
    }
} else {
   
    echo "Invalid request.";
}
?>
