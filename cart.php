<?php
session_start();
include('database.php');
$userId = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .cart {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            width: auto;
            font-size: 25px;
            text-align: center;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-size: 30px;
            background-color: #f2f2f2;
        }

        button {
            border-radius: 5px;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        .total{
            margin: 20px 0 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Shopping Cart</h1>
        <div class="message">
            <?php
            if (isset($_REQUEST['msg'])) {
                echo $_REQUEST['msg'] . "<br><br>";
            }
            ?>
        </div>
        <div class="cart">
            <?php
            $query = "SELECT c.cart_id, e.name, e.description, e.price,e.image_path FROM cart c INNER JOIN equipment e ON c.equipment_id = e.id WHERE c.user_id = $userId";
            $result = mysqli_query($con, $query);

            // Check if cart has items
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Image</th><th>Name</th><th>Description</th><th>Price</th><th>Action</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['cart_id'] . "</td>";
                    echo '<td><img style="width:80px;height:80px" src="' . $row['image_path'] . '" alt="' . $row['name'] . '"></td>';
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td><button onclick='deleteItem(" . $row['cart_id'] . ")'>Delete</button></td>";
                    echo "</tr>";
                }
                echo "</table>";
                
            } else {
                echo "Your cart is empty.";
            }
            ?>
            <div class="total">
                <?php
                $query = "select count(c.user_id) as cnt, sum(e.price) as total  FROM cart c INNER JOIN equipment e ON c.equipment_id = e.id WHERE c.user_id = $userId";
                $result = mysqli_query($con, $query);
                echo "<table border='1'>";
                echo "<tr><th>Total Items</th><th>Total Price</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo  "<td>". $row['cnt']."</td>" ;
                     echo "<td>".$row['total']."</td>" ;
                     echo "</tr>";
                }
                echo "</table>";
                echo "<button onclick='makeBulkOrder()'>Order</button>";
                ?>
                
            </div>
        </div>
    </div>

    <script>
        function deleteItem(itemId) {
            if (confirm("Are you sure you want to delete this item from your cart?")) {

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'deleteCartItem.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {

                            window.location.reload();
                        } else {
                            console.error('Error: ' + xhr.status);
                        }
                    }
                };
                xhr.send('item_id=' + encodeURIComponent(itemId));
            }
        }

        function makeBulkOrder() {
            window.location.href = 'bulk_order.php';
        }
    </script>
</body>

</html>