<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="style/login.css">
    <title>LoginUp</title>

    <style>
         .message{
            color:red;
         }
    </style>
</head>

<body>
    <div class="message">
        <?php 
            if(isset($_REQUEST['msg']))
            {
                echo $_REQUEST['msg']."<br><br>";
            }
        ?>
    </div>
    
    <form action="verifyAdminLogin.php" method="post">
        <div class="container">
            <h1>Admin Login</h1>
            <div id="mail">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div id="pass">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">LOGIN</button>
            <div class="signup">
                <a href="signup.html">SIGNUP</a><span> Dont't have a Account.</span>
                <br>
                <a href="">Forget Password</a>
                <a href="login.php">User Login</a>
            </div>
        </div>
    </form>
</body>

</html>