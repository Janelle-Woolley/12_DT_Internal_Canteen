<?php
$con = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    $database_connection = TRUE;}

$all_drinks_query = "SELECT *
                   FROM drinks, dietary_requirements
                   WHERE drinks.dietary_requirements_id = dietary_requirements.dietary_requirements_id
                   ORDER BY `drinks`.`drink_in_stock` DESC";
$all_drinks_results = mysqli_query($con, $all_drinks_query);

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
            <div class="grid-item products">
                <?php
                while($all_drinks_record = mysqli_fetch_assoc($all_drinks_results)){
                    echo $all_drinks_record['drink_name'].": ";
                    echo $all_drinks_record['drink_price'];
                    echo "<br>";
                    echo $all_drinks_record['ingredients'];
                    echo "<br>";
                    if($all_drinks_record['drink_in_stock'] == 'yes'){
                        echo "--Available--";
                    }
                    else{
                        echo "--Out of Stock--";
                    }
                    if($all_drinks_record['is_vegetarian'] == 'yes'){
                        echo " --Vegetarian--";
                    }
                    if($all_drinks_record['is_vegan'] == 'yes'){
                        echo " --Vegan--";
                    }
                    if($all_drinks_record['is_dairy_free'] == 'yes'){
                        echo " --Dairy Free--";
                    }
                    if($all_drinks_record['is_gluten_free'] == 'yes'){
                        echo " --Gluten Free--";
                    }
                    echo "<br>";
                    echo "<br>";
                }
                ?>
            </div>
            <div class="grid-item footer">
                <?php
                if($database_connection == TRUE){
                    echo "connected to database";}
                ?>
            </div>
        </div>
    </body>