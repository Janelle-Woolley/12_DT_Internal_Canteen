<?php
$con = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    $database_connection = TRUE;}
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <title> WGC Canteen </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="canteen_style.css">
    </head>

    <body>
        <div class="grid-container">
            <div class="grid-item logo"></div>
            <div class="grid-item main_heading">
                <p>WELLINGTON GIRLS' COLLAGE CANTEEN</p>
            </div>
            <div class="grid-item navigation">
                <nav>
                    <a href="canteen_home.php"> HOME </a>
                    <a href="canteen_food.php"> FOOD </a>
                    <a href="canteen_drinks.php"> DRINKS </a>
                    <a href="canteen_weekly_specials.php">  WEEKLY SPECIALS </a>
                </nav>
            </div>
            <div class="grid-item search">
                Nunc feugiat, ligula at fringilla.
            </div>
            <div class="grid-item home_heading">About Us</div>
            <div class="grid-item home_text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis congue
                   gravida tellus, id facilisis quam. Donec egestas sodales ex varius accumsan.
                   Ut scelerisque fermentum pulvinar. Aliquam sit amet metus rhoncus, porttitor
                   nulla ac, sagittis neque. Phasellus mattis ligula tortor, sit amet sodales
                   ante tempor vel. Aliquam scelerisque, mi vel sollicitudin mattis, dolor
                   justo fringilla odio, nec varius justo ex nec orci. Donec luctus nec massa
                   eget ornare. Ut eget rhoncus dolor. Donec vitae tortor porttitor felis
                   vestibulum tincidunt sed id ante. Aenean faucibus risus vitae risus
                   efficitur varius. Quisque porttitor dapibus felis, ut commodo sapien.
                   Phasellus orci erat, tempus nec neque eget, venenatis molestie nisi.
                   Curabitur pharetra placerat maximus. Aliquam egestas ligula sed diam viverra,
                   ut vulputate magna auctor. Maecenas cursus leo velit, eget dapibus nisl
                   aliquet et.</p>
            </div>
            <div class="grid-item footer">
                <?php
                if($database_connection == TRUE){
                    echo "connected to database";}
                ?>
            </div>
        </div>
    </body>