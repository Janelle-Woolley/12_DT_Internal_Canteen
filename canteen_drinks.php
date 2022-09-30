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
<!-- opens php -->
    <?php
    /* Connects page to database */
    $con = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_canteen");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
    else{
        $database_connection = TRUE;}

    /* Queries the database selecting the information from the drinks and dietary requirements tables*/
    $all_drinks_query = "SELECT *
                   FROM drinks, dietary_requirements
                   WHERE drinks.dietary_requirements_id = dietary_requirements.dietary_requirements_id
                   ORDER BY `drinks`.`drink_in_stock` DESC";
    $left_drinks_results = mysqli_query($con, $all_drinks_query);
    $right_drinks_results = mysqli_query($con, $all_drinks_query);

    /* function to print drinks info */
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

    /* Function to print minimal drinks info */
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

        <!-- filter class from style sheet -->
        <div class="grid-item filters">
            <!-- button code used from: https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/ -->
            <form method="post">
                <input type="submit" name="vegetarian"
                       class="filter" value="Vegetarian">

                <input type="submit" name="vegan"
                       class="filter" value="Vegan">

                <input type="submit" name="dairy"
                       class="filter" value="Dairy Free">

                <input type="submit" name="gluten"
                       class="filter" value="Gluten Free">

                <input type="submit" name="all_drinks"
                       class="filter" value="All Drinks">
            </form>
        </div>

        <!-- page heading class from style sheet -->
        <div class="grid-item product_page_heading">
            <h2>Drinks</h2>
        </div>

        <!-- left column class from style sheet -->
        <div class="grid-item left_products">
            <!-- opens php -->
            <?php
            /* loops through data from database */
            while($left_drinks_record = mysqli_fetch_assoc($left_drinks_results)) {
                /* checks if the drink id is not even */
                if($left_drinks_record["drink_id"]% 2 != 0){
                    /* checks if the vegetarian button is pressed */
                    if(array_key_exists('vegetarian', $_POST)){
                        if ($left_drinks_record['is_vegetarian'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($left_drinks_record);
                        }
                    }
                    /* checks if the vegan button is pressed */
                    elseif(array_key_exists('vegan', $_POST)){
                        if ($left_drinks_record['is_vegan'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($left_drinks_record);
                        }
                    }
                    /* checks if the dairy free button is pressed */
                    elseif(array_key_exists('dairy', $_POST)){
                        if ($left_drinks_record['is_dairy_free'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($left_drinks_record);
                        }
                    }
                    /* checks if the gluten-free button is pressed */
                    elseif(array_key_exists('gluten', $_POST)){
                        if ($left_drinks_record['is_gluten_free'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($left_drinks_record);
                        }
                    }
                    /* checks if the all drinks button is pressed */
                    elseif(array_key_exists('all_drinks', $_POST)){
                        /* runs function */
                        print_drinks_info($left_drinks_record);
                    }
                    else{
                        /* runs function */
                        print_drinks_info($left_drinks_record);
                    }
                }
            }
            ?>
        </div>

        <!-- right column class from style sheet -->
        <div class="grid-item right_products">
            <!-- opens php -->
            <?php
            /* loops through data from database */
            while($right_drinks_record = mysqli_fetch_assoc($right_drinks_results)) {
                /* checks if the drink id is even */
                if($right_drinks_record["drink_id"]% 2 == 0){
                    /* checks if the vegetarian button is pressed */
                    if(array_key_exists('vegetarian', $_POST)){
                        if ($right_drinks_record['is_vegetarian'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($right_drinks_record);
                        }
                    }
                    /* checks if the vegan button is pressed */
                    elseif(array_key_exists('vegan', $_POST)){

                        if ($right_drinks_record['is_vegan'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($right_drinks_record);
                        }
                    }
                    /* checks if the dairy free button is pressed */
                    elseif(array_key_exists('dairy', $_POST)){
                        if ($right_drinks_record['is_dairy_free'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($right_drinks_record);
                        }
                    }
                    /* checks if the gluten-free button is pressed */
                    elseif(array_key_exists('gluten', $_POST)){
                        if ($right_drinks_record['is_gluten_free'] == 'yes'){
                            /* runs function */
                            print_diet_drinks_info($right_drinks_record);
                        }
                    }
                    /* checks if the all drinks button is pressed */
                    elseif(array_key_exists('all_drinks', $_POST)){
                        /* runs function */
                        print_drinks_info($right_drinks_record);
                    }
                    else{
                        /* runs function */
                        print_drinks_info($right_drinks_record);
                    }
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