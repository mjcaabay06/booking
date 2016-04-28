<?php
    include "resources/mysqli_connect.php";
    session_start();

    if (isset($_SESSION["userId"])) {
        if ($_SESSION['level'] == 2) {
            header("Location: user-home.php");
        } else {
            header("Location: admin-home.php");
        }
    }

    $flashMessage = '';

    if (isset($_POST['btn-submit'])) {
        $query = "Select * From booking_users WHERE uname = '" . $_POST['uname'] . "' AND upass = '" . $_POST['upass'] . "' AND status=1";
        $rs = mysqli_query($mysqli, $query);
        $assoc = mysqli_fetch_assoc($rs);

        if ($rs !== false) {
            if ($rs->num_rows > 0) {
                $_SESSION['userId'] = $assoc["user_id"];
                $_SESSION['level'] = $assoc["level"];
                $_SESSION['name'] = $assoc["fname"] . ' ' . $assoc["lname"];
                    
                if ($assoc['level'] == 2) {
                    header("Location: user-home.php");
                } else {
                    header("Location: admin-home.php");
                }
            } else {
                $flashMessage = 'Access Denied!';
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css"></link>
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <div class="login-content">
            <div class="header">
                LOGIN
            </div>
            <div class="main">
                <form action="" method="post">
                    <label id="flashMessage"><?php echo $flashMessage; ?></label>
                    <input type="text" name="uname" placeholder="Username" /><br />
                    <input type="password" name="upass" placeholder="Password" /><br />
                    <button type="submit" class="btn" name="btn-submit">Login</button>
                    <a href="register.php" style="display: block; float:right; margin-top: 28px;">Create account.</a>
                </form>    
            </div>
        </div>
        <!--<script src="js/jquery-1.12.0.js"></script>
        <script src="js/jquery-1.12.0.min.js"></script>-->
    </body>
</html>