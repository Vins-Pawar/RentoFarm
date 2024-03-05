<?php
include('database.php');
session_start();

include('database.php');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['equipment_id'])) {

    $equipmentId = $_POST['equipment_id'];
    $userId = $_SESSION['user'];

    // Check if the item is already in the cart
    $findQuery = "SELECT * FROM cart WHERE user_id = $userId AND equipment_id = $equipmentId";
    $findResult = mysqli_query($con, $findQuery);
    if (mysqli_num_rows($findResult) > 0) {
        $response['success'] = false;
        $response['message'] = "Item is already present in the cart.";
    } else {
        // If the item is not in the cart, insert it
        $insertQuery = "INSERT INTO cart (user_id, equipment_id) VALUES ($userId, $equipmentId)";
        if (mysqli_query($con, $insertQuery)) {
            $response['success'] = true;
            $response['message'] = "Item added to cart successfully.";
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . mysqli_error($con);
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request.";
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
