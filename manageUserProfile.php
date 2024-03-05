<?php
include('database.php');
session_start();
$user = $_SESSION['user'];
if (!isset($user))
    header("location:login.php?msg=Please Login");
else {
    $query = "select * from register where userid='$user'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result)) {
        $name = $row[1];
        $email = $row[2];
        $password = $row[3];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        #message {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">



    <body>
        <div class="container">
            <h1>Profile Management</h1>
            <form id="profileForm" method="post" action="update_profile.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name ?>" required>
                <label for="name">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>" required>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password">
                <input type="submit" value="Save Changes">
            </form>
            <?php if (isset($_GET['msg'])) { ?>
                <div id="message"><?php echo $_GET['msg']; ?></div>
            <?php } ?>
        </div>
    </body>

    </html>
    F
</body>

</html>