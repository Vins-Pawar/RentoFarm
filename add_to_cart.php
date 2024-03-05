<?php
include('database.php');
session_start();

include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['equipment_id'])) {

    $equipmentId = $_POST['equipment_id'];
    echo $equipmentId;

    $userId = $_SESSION['user'];
    $findQuery="SELECT c.card_id from cart c where user_id= $userId and equipment_id= $equipmentId;";
    
    $insertQuery = "INSERT INTO cart (user_id, equipment_id) VALUES ($userId, $equipmentId)";

    if (mysqli_query($con, $insertQuery)) {

        echo "Item added to cart successfully.";
    } else {

        echo "Error: " . mysqli_error($con);
    }
} else {
     
    echo "Invalid request.";
}
