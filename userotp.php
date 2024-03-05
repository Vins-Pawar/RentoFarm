<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify</title>
</head>
<body>
    <h1>Verify Email</h1>
    <?php
        if(isset($_REQUEST['msg']))
        {
            echo $_REQUEST['msg']."<br><br>";
        }
    ?>
    <form action="verify.php" method="post">
    Enter otp:
         <?php 
            if(isset($_REQUEST['msg']))
            {
                echo $_REQUEST['msg']."<br><br>";
            }
        ?>
        <input type="number" name="otp" id="" placeholder="5 digit otp">
        <br>
        <button type="submit">verify OTP</button>
    </form>
</body>
</html>