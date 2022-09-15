<?php
$con = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";}

$all_food_query = "SELECT *
                   FROM food, dietary_requirements
                   WHERE food.dietary_requirements_id = dietary_requirements.dietary_requirements_id
                   ORDER BY `food`.`food_in_stock` DESC";
$all_food_results = mysqli_query($con, $all_food_query);

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
                while($all_food_record = mysqli_fetch_assoc($all_food_results)){
                    echo $all_food_record['food_name'].": ";
                    echo $all_food_record['food_price'];
                    echo "<br>";
                    echo $all_food_record['ingredients'];
                    if($all_food_record['food_in_stock'] == 'yes'){
                        echo "<br>";
                        echo "--Available--";
                    }
                    else{
                        echo "<br>";
                        echo "--Out of Stock--";
                    }
                    if($all_food_record['is_vegetarian'] == 'yes'){
                        echo " --Vegetarian--";
                    }
                    if($all_food_record['is_vegan']== 'yes'){
                        echo " --Vegan--";
                    }
                    if($all_food_record['is_dairy_free']== 'yes'){
                        echo " --Dairy Free--";
                    }
                    if($all_food_record['is_gluten_free']== 'yes'){
                        echo " --Gluten Free--";
                    }
                    if($all_food_record['is_meat']== 'yes'){
                        echo " --Meat--";
                    }
                    echo "<br>";
                    echo "<br>";
                }
                ?>
            </div>
            <div class="grid-item footer"></div>
        </div>
    </body>