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
            <div class="grid-item heading"></div>
            <div class="grid-item navigation">
                <nav>
                    <a href="canteen_home.php"> HOME </a>
                    <a href="canteen_food.php"> FOOD </a>
                    <a href="canteen_drinks.php"> DRINKS </a>
                    <a href="canteen_weekly_specials.php">  WEEKLY SPECIALS </a>
                </nav>
            </div>
            <div class="grid-item search"></div>
            <div class="grid-item filters"></div>
            <div class="grid-item page_heading"></div>
            <div class="grid-item products"></div>
            <div class="grid-item footer">
                <?php
                if($database_connection == TRUE){
                    echo "connected to database";}
                ?>
            </div>
        </div>
    </body>