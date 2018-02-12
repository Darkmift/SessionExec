<?php
session_start();
$showname = $_SESSION['username'];
if (empty($showname)) {
    $message = 'Please go <a href="Login.php">here</a> to set your name.';
} else {
    $message = "Welcome " . $showname . "!";
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
                <h1>Show Name</h1>
                <?php
                echo "<br>" . $message;
                ?>
                <br>
                <br>
                <button id="mute">Mute</button>
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