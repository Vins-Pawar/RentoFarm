<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    
    $new_image_name = $name . '_' . time() . '.' . $image_extension;

    $image_path = "equipment_images/" . $new_image_name;
    move_uploaded_file($image_tmp, $image_path);

    $query = "INSERT INTO equipment (name, description, price, image_path) VALUES ('$name', '$description', '$price', '$image_path')";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("location:addEquipment.php?msg=Equipment is Added");
    } else {
        header("location:addEquipment.php?msg=Brror in Adding Equipment");
        echo "Error adding equipment: " . mysqli_error($con);
    }
}
?>
