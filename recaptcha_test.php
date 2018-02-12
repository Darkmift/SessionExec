<?php
session_start();
unset($_SESSION['username']);
$username = $name = $message = $Gmessage = $response = $tester = $captcha = "";
$name = $_POST['username'];
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {

    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }
    if (!$captcha) {
        $Gmessage = '<h2>Please check the the captcha form.</h2>';
    }

    $secretKey = "6LfTdSgUAAAAABvv7Csbpb7R_or-NzKm8yTH5BC9";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
    $responseKeys = json_decode($response, true);
    if (intval($responseKeys["success"]) !== 1) {
        $Gmessage = "error!";
        $message = 'Captcha Validation failed.Bots are not welcome';
        unset($_SESSION['username']);
    } else {
        $Gmessage = "success!";
        if (isset($name)) {
            if (empty($name)) {
                $message = 'Name Is Requierd';
            } else {
                $username = $name;
                $message = 'Welcome Home <a href=ShowName.php>' . $username . '</a>!';
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
}
?>

<!DOCTYPE html>

<html>

    <head>
        <title>Default</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
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
                <form class="row" method="POST" action="recaptcha_test.php" name="myform">
                    Your Name Here: <input name="username" type="text" value="">
                    <span class="col-xs-12" style="height:25px;" id="smallscreen"></span>
                    <br><br>
                    <center>
                        <div class="g-recaptcha" data-sitekey="6LfTdSgUAAAAAEb_nxNUIizLdRwFOK5f1saZGVHJ"></div>
                    </center>
                    <br>
                    <input  type="submit" name="submitBtn" value="Submit">
                    <button id="mute" onclick="return false;">Mute</button>
                </form>
                <?php
                echo "<br>";
                echo $message;
                echo "<br>";
                echo $Gmessage;
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