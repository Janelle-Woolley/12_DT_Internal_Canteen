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
            <div class="grid-item logo">
                <a href="canteen_home.php" class="image">
                    <img src="wgc_logo.jpg" alt="Wellington Girls' College Logo" height="125" width="125">
                </a>
            </div>
            <div class="grid-item main_heading">
                <h1>WELLINGTON GIRLS' COLLEGE CANTEEN</h1>
            </div>
            <div class="grid-item navigation">
                <nav>
                    <a href="canteen_home.php"> HOME </a>
                    <a href="canteen_food.php"> FOOD </a>
                    <a href="canteen_drinks.php"> DRINKS </a>
                    <a href="canteen_weekly_specials.php">  WEEKLY SPECIALS </a>
                </nav>
            </div>
            <div class="grid-item logo_right">
                <a href="canteen_home.php" class="image">
                    <img src="wgc_logo.jpg" alt="Wellington Girls' College Logo" height="125" width="125">
                </a>
            </div>
            <div class="grid-item upper_heading">
                <h2>About Us</h2>
            </div>
            <div class="grid-item home_text">
                <p>
                    We are the Wellington Girls' College Canteen.
                    <br>
                    <br>
                    We offer a range of drinks and foods that meet a variety of dietary requirements.
                    <br>
                    <br>
                    We also have a range of specials that rotate weekly.
                    <br>
                    <br>
                    The canteen is located at 18 Pipitea Street, Thorndon, Wellington underneath the music rooms and next to the driveway Pipetea Street driveway.
                </p>
            </div>
            <div class="grid-item footer">
                <?php
                if($database_connection == TRUE){
                    echo " Connected to database";}
                ?>
                &copy; Wellington Girls' College 2022 (Janelle Woolley)
            </div>
        </div>
    </body>