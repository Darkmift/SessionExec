<?php
session_start();
unset($_SESSION['username']);
$username = $name = $message = "";
$name = $_POST['username'];
$username = $_SESSION['username'];
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {
    if (isset($name)) {
        if (empty($name)) {
            $username = 'Name Is Requierd';
        } else {
            $username = $name;
            $message = "Wlecome <a href=ShowName.php>" . $username . "!";
            $_SESSION['username'] = $username;
            if (strlen($name) < 3) {
                $message = 'Name Must Be More Then 3 letters';
                unset($_SESSION['username']);
            }
            if (str_word_count($name) < 2) {
                $message = 'Name Must Contain 2 Words';
                unset($_SESSION['username']);
            }
        }
    }
}
?>

<!DOCTYPE html>

<html>

    <head>
        <title>Default</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="http://pre11.deviantart.net/3944/th/pre/i/2012/122/6/9/cookie_monster_by_neorame-d4yb0b5.png" />
        <!--bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
        <!-- Optional theme -->
        <link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet" crossorigin="anonymous">
        <link  href="CSS/SessionExec.css" rel="stylesheet" crossorigin="anonymous">

    </head>

    <body>
        <?php
        include 'header.php';
        include 'footer.php';
        ?>

        <div class="main">
            <div class="main-div">
                <h1>Login</h1>
                <br>
                <form class="row" method="POST" action="Login.php" name="myform">
                    Your Name Here: <input name="username" type="text" value="<?php //echo $name                       ?>">
                    <span class="col-xs-12" style="height:25px;" id="smallscreen"></span>
                    <input  type="submit" name="submitBtn" value="Submit">
                    <button id="mute" onclick="return false;">Mute</button>
                </form>

                <?php
                echo $message;
                ?>
            </div>
        </div>

        <!--Video element START-->
        <div class="tv">
            <div class="screen mute" id="tv"></div>
        </div>
        <!--Video element END-->

        <!--END OF HTML HERE-->
        <!--Jquery(Bootstrap dependency)-->
        <script src="https://code.jquery.com/jquery-latest.min.js"></script>
        <!--Bootstrap Plugins-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="SessionExec2.js"></script>


    </body>

</html>