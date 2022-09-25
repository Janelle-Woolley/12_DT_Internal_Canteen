<?php
$con = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    $database_connection = TRUE;}

$all_food_query = "SELECT *
                   FROM food, dietary_requirements
                   WHERE food.dietary_requirements_id = dietary_requirements.dietary_requirements_id
                   ORDER BY `food`.`food_in_stock` DESC";
$right_food_results = mysqli_query($con, $all_food_query);
$left_food_results = mysqli_query($con, $all_food_query);
$diet_food_results = mysqli_query($con, $all_food_query);

function print_food_info($database_record){
    echo $database_record['food_name'].": ";
    echo $database_record['food_price'];
    echo "<br>";
    echo $database_record['ingredients'];
    echo "<br>";
    if($database_record['food_in_stock'] == 'yes'){
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
    if($database_record['is_meat'] == 'yes'){
        echo " --Meat--";
    }
    echo "<br>";
    echo "<br>";
}
function print_diet_food_info($database_record){
    echo $database_record['food_name'].": ";
    echo $database_record['food_price'];
    echo "<br>";
    if($database_record['food_in_stock'] == 'yes'){
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
            <div class="grid-item search">
                <form action="" method="post">
                    <input type="text" name="search">
                    <input type="submit" name="submit" value="Search">
                </form>
            </div>
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

                    <input type="submit" name="meat"
                           class="button" value="Meat"/>

                    <input type="submit" name="all_food"
                           class="button" value="All Foods"/>
                </form>
            </div>
            <div class="grid-item product_page_heading">
                <h1>Food</h1>
            </div>
            <div class="grid-item left_products">
                <?php
                if(isset($_POST['search'])){
                    $search = $_POST['search'];

                    $search_query_food = "SELECT food_name, food_price 
                                     FROM food
                                     WHERE food_name LIKE '%$search%'";
                    $search_query_food_results = mysqli_query($con, $search_query_food);
                    $count = mysqli_num_rows($search_query_food_results);

                    if($count == 0){
                        echo "There were no search results!";
                    }
                    else{
                        while($row = mysqli_fetch_array($search_query_food_results)){
                            echo $row['food_name'].": ";
                            echo $row['food_price'];
                            echo "<br>";
                        }
                    }
                }
                while($left_food_record = mysqli_fetch_assoc($left_food_results)){
                    if($left_food_record["food_id"]% 2 != 0){
                        if(array_key_exists('vegetarian', $_POST)){
                            if ($left_food_record['is_vegetarian'] == 'yes'){
                                print_diet_food_info($left_food_record);
                            }
                        }
                        elseif(array_key_exists('vegan', $_POST)){
                            if ($left_food_record['is_vegan'] == 'yes'){
                                print_diet_food_info($left_food_record);
                            }
                        }
                        elseif(array_key_exists('dairy', $_POST)){
                            if ($left_food_record['is_dairy_free'] == 'yes'){
                                print_diet_food_info($left_food_record);
                            }
                        }
                        elseif(array_key_exists('gluten', $_POST)){
                            if ($left_food_record['is_gluten_free'] == 'yes'){
                                print_diet_food_info($left_food_record);
                            }
                        }
                        elseif(array_key_exists('meat', $_POST)){
                            if ($left_food_record['is_meat'] == 'yes'){
                                print_diet_food_info($left_food_record);
                            }
                        }
                        elseif(array_key_exists('all_food', $_POST)){
                            print_food_info($left_food_record);
                        }
                        else{
                            print_food_info($left_food_record);
                        }
                    }
                }
                ?>
            </div>
            <div class="grid-item right_products">
                <?php
                while($right_food_record = mysqli_fetch_assoc($right_food_results)){
                    if($right_food_record["food_id"]% 2 == 0){
                        if(array_key_exists('vegetarian', $_POST)){
                            if ($right_food_record['is_vegetarian'] == 'yes'){
                                print_diet_food_info($right_food_record);
                            }
                        }
                        elseif(array_key_exists('vegan', $_POST)){
                            if ($right_food_record['is_vegan'] == 'yes'){
                                print_diet_food_info($right_food_record);
                            }
                        }
                        elseif(array_key_exists('dairy', $_POST)){
                            if ($right_food_record['is_dairy_free'] == 'yes'){
                                print_diet_food_info($right_food_record);
                            }
                        }
                        elseif(array_key_exists('gluten', $_POST)){
                            if ($right_food_record['is_gluten_free'] == 'yes'){
                                print_diet_food_info($right_food_record);
                            }
                        }
                        elseif(array_key_exists('meat', $_POST)){
                            if ($right_food_record['is_meat'] == 'yes'){
                                print_diet_food_info($right_food_record);
                            }
                        }
                        elseif(array_key_exists('all_food', $_POST)){
                            print_food_info($right_food_record);
                        }
                        else{
                            print_food_info($right_food_record);
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