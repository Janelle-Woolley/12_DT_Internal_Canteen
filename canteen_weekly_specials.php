<!DOCTYPE html>

<!-- Sets document language to english -->
<html lang="en">

    <!-- Creates title (displays in browser bar)
    Sets charset to utf-8 (setting character encoding)
    Links to CSS style sheet-->
    <head>
        <title> WGC Canteen </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="canteen_style.css">
    </head>

    <body>
    <!-- Opens php -->
    <?php
    /* Connects page to database */
    $con = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_canteen");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
    else{
        $database_connection = TRUE;}

    /* Queries the database selecting the information weekly special table*/
    $all_weekly_special_query = "SELECT weekly_specials.week_number, weekly_specials.special_price, 
                             weekly_specials.food_id, weekly_specials.drink_id 
                             FROM weekly_specials
                             ORDER BY weekly_specials.week_number ASC";
    $left_weekly_special_results = mysqli_query($con, $all_weekly_special_query);
    $right_weekly_special_results = mysqli_query($con, $all_weekly_special_query);

    /* function to print weekly special info */
    function print_weekly_special_info($database_record, $database_connection){
        /* Queries the database selecting the information from the food and dietary requirements tables*/
        $single_food_query = "SELECT *
                      FROM food, dietary_requirements 
                      WHERE food.dietary_requirements_id = dietary_requirements.dietary_requirements_id 
                      AND food.food_id = '" .$database_record['food_id']. "'";
        $single_food_results = mysqli_query($database_connection, $single_food_query);
        $single_food_record = mysqli_fetch_assoc($single_food_results);

        /* Queries the database selecting the information from the drinks and dietary requirements tables*/
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
    <!-- Creates grid -->
    <div class="grid-container">
        <!-- logo class from style sheet -->
        <div class="grid-item logo">
            <!-- Creates a link to the home page using the logo image as the button
             the image is given a height, width and alt text-->
            <a href="canteen_home.php" class="image">
                <!-- Alt will display if the image cannot be loaded
                 or used by a text to speech machine -->
                <img src="wgc_logo.jpg" alt="Wellington Girls' College Logo" height="125" width="125">
            </a>
        </div>

        <!--  website heading class from style sheet -->
        <div class="grid-item main_heading">
            <h1>WELLINGTON GIRLS' COLLEGE CANTEEN</h1>
        </div>

        <!-- navigation class from style sheet -->
        <div class="grid-item navigation">
            <nav>
                <!-- Creates links to each page with names -->
                <a href="canteen_home.php"> HOME </a>
                <a href="canteen_food.php"> FOOD </a>
                <a href="canteen_drinks.php"> DRINKS </a>
                <a href="canteen_weekly_specials.php">  WEEKLY SPECIALS </a>
            </nav>
        </div>

        <!-- right logo class from style sheet
        this is used to fill the space where the search feature goes on other pages-->
        <div class="grid-item logo_right">
            <!-- Creates a link to the home page using the logo image as the button
             the image is given a height, width and alt text-->
            <a href="canteen_home.php" class="image">
                <!-- Alt will display if the image cannot be loaded
                 or used by a text to speech machine -->
                <img src="wgc_logo.jpg" alt="Wellington Girls' College Logo" height="125" width="125">
            </a>
        </div>

        <!-- page heading class from style sheet -->
        <div class="grid-item upper_heading">
            <h2>Weekly Specials</h2>
        </div>

        <!-- Text section class from style sheet -->
        <div class="grid-item weekly_special_text">
            <!-- prints out text -->
            <p>
                Each week a food and drink can be brought together as a weekly special.
                <br>
                We have 12 rotating weekly specials.
            </p>
        </div>

        <!-- left column class from style sheet -->
        <div class="grid-item left_products">
            <!-- opens php -->
            <?php
            /* loops through data from database */
            while($left_weekly_special_record = mysqli_fetch_assoc($left_weekly_special_results)){
                /* checks if the drink id is not even */
                if($left_weekly_special_record['week_number']% 2 != 0){
                    /* runs function */
                    print_weekly_special_info($left_weekly_special_record, $con);
                }
            }
            ?>
        </div>

        <!-- right column class from style sheet -->
        <div class="grid-item right_products">
            <!-- opens php -->
            <?php
            /* loops through data from database */
            while($right_weekly_special_record = mysqli_fetch_assoc($right_weekly_special_results)){
                /* checks if the drink id is even */
                if($right_weekly_special_record['week_number']% 2 == 0){
                    /* runs function */
                    print_weekly_special_info($right_weekly_special_record, $con);
                }
            }
            ?>
        </div>

        <!-- footer class from style sheet -->
        <div class="grid-item footer">
            <!-- opens php -->
            <?php
            /* Checks if page is connected to database
            If the page is connected to the database it prints out a statement*/
            if($database_connection == TRUE){
                echo " Connected to database";}
            ?>
            &copy; Wellington Girls' College 2022 (Janelle Woolley)
        </div>
    </div>
    </body>