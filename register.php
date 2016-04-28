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
        $query = "
            INSERT INTO
                `booking_users`
            (
                `fname`,
                `lname`,
                `uname`,
                `upass`,
                `level`,
                `status`,
                `created_date`,
                `modified_date`
            )
            VALUES
            (
                '" . mysqli_real_escape_string($mysqli, $_POST['fname']) . "',
                '" . mysqli_real_escape_string($mysqli, $_POST['lname']) . "',
                '" . mysqli_real_escape_string($mysqli, $_POST['uname']) . "',
                '" . mysqli_real_escape_string($mysqli, $_POST['upass']) . "',
                2,
                1,
                NOW(),
                NOW()
            )
        ";
        $rs = mysqli_query($mysqli, $query);

        if ($rs !== false) {
            $_SESSION['userId'] = mysqli_insert_id($mysqli);
            $_SESSION['level'] = 2;
            header("Location: user-home.php");
        } else {
            $flashMessage = 'Registration Denied!';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css"></link>
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>
        <div class="login-content">
            <div class="header">
                REGISTER
            </div>
            <div class="main">
                <form action="" method="post">
                    <label id="flashMessage"><?php echo $flashMessage; ?></label>

                    <input type="text" name="fname" placeholder="First Name" /><br/>
                    <input type="text" name="lname" placeholder="Last Name" /><br/>
                    <input type="text" name="uname" placeholder="Username" /><br/>
                    <input type="password" name="upass" placeholder="Password" /><br/>

                    <button type="submit" class="btn" name="btn-submit">Register</button>
                    <a href="index.php" style="display: block; float:right; margin-top: 28px;">Log in.</a>
                </form>    
            </div>
        </div>
        <!--<script src="js/jquery-1.12.0.js"></script>
        <script src="js/jquery-1.12.0.min.js"></script>-->
    </body>
</html>