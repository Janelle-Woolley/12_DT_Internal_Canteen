<?php
$con = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    $database_connection = TRUE;}

$all_weekly_special_query = "SELECT weekly_specials.week_number, weekly_specials.special_price, 
                             weekly_specials.food_id, weekly_specials.drink_id 
                             FROM weekly_specials
                             ORDER BY weekly_specials.week_number ASC";
$left_weekly_special_results = mysqli_query($con, $all_weekly_special_query);
$right_weekly_special_results = mysqli_query($con, $all_weekly_special_query);

function print_weekly_special_info($database_record, $database_connection){
    $single_food_query = "SELECT *
                      FROM food, dietary_requirements 
                      WHERE food.dietary_requirements_id = dietary_requirements.dietary_requirements_id 
                      AND food.food_id = '" .$database_record['food_id']. "'";
    $single_food_results = mysqli_query($database_connection, $single_food_query);
    $single_food_record = mysqli_fetch_assoc($single_food_results);

    $single_drink_query = "SELECT *
                      FROM drinks, dietary_requirements 
                      WHERE drinks.dietary_requirements_id = dietary_requirements.dietary_requirements_id 
                      AND drinks.drink_id = '" .$database_record['drink_id']. "'";
    $single_drink_results = mysqli_query($database_connection, $single_drink_query);
    $single_drink_record = mysqli_fetch_assoc($single_drink_results);

    echo "Week ".$database_record['week_number'];
    echo "<br>";
    echo $single_food_record['food_name']." and ".$single_drink_record['drink_name'];
    echo "<br>";
    echo $database_record['special_price'];
    echo "<br>";
    if($single_food_record['food_in_stock'] == 'yes' and $single_drink_record['drink_in_stock'] == 'yes'){
        echo "--Available--";
    }
    else{
        echo "--Out of Stock--";
    }
    if($single_food_record['is_vegetarian'] == 'yes' and $single_drink_record['is_vegetarian'] == 'yes'){
        echo " --Vegetarian--";
    }
    if($single_food_record['is_vegan'] == 'yes' and $single_drink_record['is_vegan'] == 'yes'){
        echo " --Vegan--";
    }
    if($single_food_record['is_dairy_free'] == 'yes' and $single_drink_record['is_dairy_free'] == 'yes'){
        echo " --Dairy Free--";
    }
    if($single_food_record['is_gluten_free'] == 'yes' and $single_drink_record['is_gluten_free'] == 'yes'){
        echo " --Gluten Free--";
    }
    echo "<br>";
    echo "<br>";
}
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
            <div class="grid-item main_heading"></div>
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
            <div class="grid-item product_page_heading"></div>
            <div class="grid-item left_products">
                <?php
                while($right_weekly_special_record = mysqli_fetch_assoc($right_weekly_special_results)){
                    if($right_weekly_special_record['week_number']% 2 != 0){
                        print_weekly_special_info($right_weekly_special_record, $con);
                    }
                }
                ?>
            </div>
            <div class="grid-item right_products">
                <?php
                while($left_weekly_special_record = mysqli_fetch_assoc($left_weekly_special_results)){
                    if($left_weekly_special_record['week_number']% 2 == 0){
                        print_weekly_special_info($left_weekly_special_record, $con);
                    }
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