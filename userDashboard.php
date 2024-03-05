<?php
include('database.php');
session_start();
$user = $_SESSION['user'];
if (!isset($user))
    header("location:login.php?msg=Please Login");
else {
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="userdashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .equipment-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .equipment {
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .equipment img {
            width: 100%;
            height: auto;
        }

        .equipment-details {
            padding: 20px;
        }

        .equipment-details h2 {
            margin-top: 0;
            color: #333;
        }

        .equipment-details p {
            margin: 10px 0;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        .book,
        .add-to-cart {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .rent-button:hover,
        .add-to-cart-button:hover {
            background-color: #0056b3;
        }

        #notification {
            position: fixed;
            font-size: 25px;
            top: 20%;
            right: 50%;
            padding: 40px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            display: none;
            z-index: 9999;
        }

        #closeBtn {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div id="sidebar">
        <ul>
            <li><a href="html/project.html" class="active">Home</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="myOrders.html">My Orders</a></li>
            <li><a href="manageUserProfile.php">Manage Profile</a></li>
            <li><a href="userLogout.php">logout</a></li>
        </ul>
    </div>


    <div id="main-content">
        <header id="user-header">
            <div class="container">
                <div class="logo" onclick="toggleMenu()">
                    <img src="./html/profile_image.png" alt="User Logo" width="80px" height="80px" style="border-radius: 50%;">

                </div>
                <nav id="dashboard-menu">
                    <ul>
                        <li class="nav-item">
                            <input type="text" class="form-control" id="searchEquipment" placeholder="Search Equipment">
                            <button class="btn btn-primary" onclick="searchEquipment()">Search</button>
                        </li>

                    </ul>
                </nav>
            </div>
        </header>

        <section id="dashboard-content" class="container">
            <div id="notification">
                <span id="closeBtn">&times;</span>
                <span id="notificationMessage"></span>
            </div>

    </div>
    <div class="container">
        <h1>Equipment Catalog</h1>
        <div class="equipment-container">
            <?php
            include('database.php');
            $query = "SELECT * FROM equipment";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="equipment">';
                    echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
                    echo '<div class="equipment-details">';
                    echo '<h2>' . $row['name'] . '</h2>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p>Price: ₹' . $row['price'] . '</p>';
                    echo '<div class="buttons">';
                    echo '<button class="add-to-cart" data-equipment-id="' . $row['id'] . '">Add to Cart</button>';
                    echo '<button class="book" data-equipment-id="' . $row['id'] . '">Book Now</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No equipment found.</p>';
            }
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addToCartButtons = document.querySelectorAll('.add-to-cart');

            addToCartButtons.forEach(function(button) {
                button.addEventListener('click', function() {

                    var equipmentId = button.getAttribute('data-equipment-id');


                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'add_to_cart.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);
                                displayNotification('Item Added to Cart');
                            } else {
                                displayNotification('Error: ' + xhr.status);
                            }
                        }
                    };
                    xhr.send('equipment_id=' + encodeURIComponent(equipmentId));
                });
            });
        });


        // bookButtons.forEach(function(button) {
        //     button.addEventListener('click', function() {
        //         var equipmentId = button.getAttribute('data-equipment-id');
        //         // Implement book functionality here
        //         console.log('Book clicked for equipment with ID:', equipmentId);
        //     });
        // });

        function displayNotification(message) {
            var notification = document.getElementById('notification');
            var notificationMessage = document.getElementById('notificationMessage');
            notificationMessage.textContent = message;
            notification.style.display = 'block';

            var closeBtn = document.getElementById('closeBtn');
            closeBtn.onclick = function() {
                notification.style.display = 'none';
            };
        }
    </script>
    </section>

    <!-- Footer section for user dashboard -->
    <footer id="user-footer" class="container">
        <!-- Footer content -->
    </footer>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="userdashboard.js"></script>
</body>

</html>