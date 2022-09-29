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
$left_drinks_results = mysqli_query($con, $all_drinks_query);
$right_drinks_results = mysqli_query($con, $all_drinks_query);

function print_drinks_info($database_record){
    echo $database_record['drink_name'].": ";
    echo $database_record['drink_price'];
    echo "<br>";
    echo $database_record['ingredients'];
    echo "<br>";
    if($database_record['drink_in_stock'] == 'yes'){
        echo "--Available--";
    }
    else{
        echo "--Out of Stock--";
    }
    if($database_record['is_vegetarian'] == 'yes'){
        echo " --Vegetarian--";
    }
    if($database_record['is_vegan'] == 'yes'){
        echo " --Vegan--";
    }
    if($database_record['is_dairy_free'] == 'yes'){
        echo " --Dairy Free--";
    }
    if($database_record['is_gluten_free'] == 'yes'){
        echo " --Gluten Free--";
    }
    echo "<br>";
    echo "<br>";
}
function print_diet_drinks_info($database_record){
    echo $database_record['drink_name'].": ";
    echo $database_record['drink_price'];
    echo "<br>";
    if($database_record['drink_in_stock'] == 'yes'){
        echo "--Available--";
    }
    else{
        echo "--Out of Stock--";
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
            <div class="grid-item search"></div>
            <div class="grid-item filters">
                <! -- code used from: https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/ -->
                <form method="post">
                    <input type="submit" name="vegetarian"
                           class="button" value="Vegetarian" />

                    <input type="submit" name="vegan"
                           class="button" value="Vegan" />

                    <input type="submit" name="dairy"
                           class="button" value="Dairy Free"/>

                    <input type="submit" name="gluten"
                           class="button" value="Gluten Free"/>

                    <input type="submit" name="all_drinks"
                           class="button" value="All Drinks"/>
                </form>
            </div>
            <div class="grid-item product_page_heading">
                <h2>Drinks</h2>
            </div>
            <div class="grid-item left_products">
                <?php
                while($left_drinks_record = mysqli_fetch_assoc($left_drinks_results)) {
                    if($left_drinks_record["drink_id"]% 2 != 0){
                        if(array_key_exists('vegetarian', $_POST)){
                            if ($left_drinks_record['is_vegetarian'] == 'yes'){
                                print_diet_drinks_info($left_drinks_record);
                            }
                        }
                        elseif(array_key_exists('vegan', $_POST)){
                            if ($left_drinks_record['is_vegan'] == 'yes'){
                                print_diet_drinks_info($left_drinks_record);
                            }
                        }
                        elseif(array_key_exists('dairy', $_POST)){
                            if ($left_drinks_record['is_dairy_free'] == 'yes'){
                                print_diet_drinks_info($left_drinks_record);
                            }
                        }
                        elseif(array_key_exists('gluten', $_POST)){
                            if ($left_drinks_record['is_gluten_free'] == 'yes'){
                                print_diet_drinks_info($left_drinks_record);
                            }
                        }
                        elseif(array_key_exists('all_drinks', $_POST)){
                            print_drinks_info($left_drinks_record);
                        }
                        else{
                            print_drinks_info($left_drinks_record);
                        }
                    }
                }
                ?>
            </div>
            <div class="grid-item right_products">
                <?php
                while($right_drinks_record = mysqli_fetch_assoc($right_drinks_results)) {
                    if($right_drinks_record["drink_id"]% 2 == 0){
                        if(array_key_exists('vegetarian', $_POST)){
                            if ($right_drinks_record['is_vegetarian'] == 'yes'){
                                print_diet_drinks_info($right_drinks_record);
                            }
                        }
                        elseif(array_key_exists('vegan', $_POST)){
                            if ($right_drinks_record['is_vegan'] == 'yes'){
                                print_diet_drinks_info($right_drinks_record);
                            }
                        }
                        elseif(array_key_exists('dairy', $_POST)){
                            if ($right_drinks_record['is_dairy_free'] == 'yes'){
                                print_diet_drinks_info($right_drinks_record);
                            }
                        }
                        elseif(array_key_exists('gluten', $_POST)){
                            if ($right_drinks_record['is_gluten_free'] == 'yes'){
                                print_diet_drinks_info($right_drinks_record);
                            }
                        }
                        elseif(array_key_exists('all_drinks', $_POST)){
                            print_drinks_info($right_drinks_record);
                        }
                        else{
                            print_drinks_info($right_drinks_record);
                        }
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