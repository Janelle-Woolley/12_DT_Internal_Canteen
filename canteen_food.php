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

    /* Queries the database selecting the information from the food and dietary requirements tables*/
    $all_food_query = "SELECT *
                   FROM food, dietary_requirements
                   WHERE food.dietary_requirements_id = dietary_requirements.dietary_requirements_id
                   ORDER BY `food`.`food_in_stock` DESC";
    $right_food_results = mysqli_query($con, $all_food_query);
    $left_food_results = mysqli_query($con, $all_food_query);
    $diet_food_results = mysqli_query($con, $all_food_query);

    /* function to print food info */
    function print_food_info($database_record){
        echo $database_record['food_name'].": ";
        echo $database_record['food_price'];
        echo "<br>";
        echo $database_record['ingredients'];
        echo "<br>";
        /* Checks if food is in stock */
        if($database_record['food_in_stock'] == 'yes'){
            echo "Available";
        }
        else{
            echo "Out of Stock";
        }
        echo "<br>";
        /* Checks if food is vegetarian */
        if($database_record['is_vegetarian'] == 'yes'){
            echo "Vegetarian, ";
        }
        /* Checks if food is vegan */
        if($database_record['is_vegan'] == 'yes'){
            echo "Vegan, ";
        }
        /* Checks if food is dairy free */
        if($database_record['is_dairy_free'] == 'yes'){
            echo "Dairy Free, ";
        }
        /* Checks if food is gluten-free */
        if($database_record['is_gluten_free'] == 'yes'){
            echo "Gluten Free, ";
        }
        /* Checks if food contains meat */
        if($database_record['is_meat'] == 'yes'){
            echo "Meat";
        }
        echo "<br>";
        echo "<br>";
    }

    /* Function to print minimal food info */
    function print_diet_food_info($database_record){
        echo $database_record['food_name'].": ";
        echo $database_record['food_price'];
        echo "<br>";
        /* Checks if food is in stock */
        if($database_record['food_in_stock'] == 'yes'){
            echo "Available";
        }
        else{
            echo "Out of Stock";
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

        <div class="grid-item search">
            <form method="post">
                <input type="text" name="search">
                <input type="submit" name="submit" value="Search" class="search_button">
            </form>
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

                <input type="submit" name="meat"
                       class="filter" value="Meat">

                <input type="submit" name="all_food"
                       class="filter" value="All Foods">
            </form>
        </div>

        <!-- page heading class from style sheet -->
        <div class="grid-item product_page_heading">
            <h2>Food</h2>
        </div>

        <!-- left column class from style sheet -->
        <div class="grid-item left_products">
            <!-- opens php -->
            <?php
            /* searches database to see if the input matches */
            if(isset($_POST['search'])){
                $search = $_POST['search'];

                $search_query_food = "SELECT food_name, food_price 
                                         FROM food
                                         WHERE food_name LIKE '%$search%'";
                $search_query_food_results = mysqli_query($con, $search_query_food);
                $count = mysqli_num_rows($search_query_food_results);

                /* checks if there are any results from the search */
                if($count == 0){
                    echo "There were no search results!";
                }
                else{
                    /* prints search results */
                    echo "Results: <br>";
                    while($row = mysqli_fetch_array($search_query_food_results)){
                        echo $row['food_name'].": ";
                        echo $row['food_price'];
                        echo "<br>";
                    }
                }
                echo "<br>";
                echo "<br>";
            }

            /* loops through data from database */
            while($left_food_record = mysqli_fetch_assoc($left_food_results)){
                /* checks if the food id is not even */
                if($left_food_record["food_id"]% 2 != 0){
                    /* checks if the vegetarian button is pressed */
                    if(array_key_exists('vegetarian', $_POST)){
                        if ($left_food_record['is_vegetarian'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($left_food_record);
                        }
                    }
                    /* checks if the vegan button is pressed */
                    elseif(array_key_exists('vegan', $_POST)){
                        if ($left_food_record['is_vegan'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($left_food_record);
                        }
                    }
                    /* checks if the dairy free button is pressed */
                    elseif(array_key_exists('dairy', $_POST)){
                        if ($left_food_record['is_dairy_free'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($left_food_record);
                        }
                    }
                    /* checks if the gluten-free button is pressed */
                    elseif(array_key_exists('gluten', $_POST)){
                        if ($left_food_record['is_gluten_free'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($left_food_record);
                        }
                    }
                    /* checks if the contains meat button is pressed */
                    elseif(array_key_exists('meat', $_POST)){
                        if ($left_food_record['is_meat'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($left_food_record);
                        }
                    }
                    /* checks if the all food button is pressed */
                    elseif(array_key_exists('all_food', $_POST)){
                        /* runs function */
                        print_food_info($left_food_record);
                    }
                    else{
                        /* runs function */
                        print_food_info($left_food_record);
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
            while($right_food_record = mysqli_fetch_assoc($right_food_results)){
                /* checks if the food id is even */
                if($right_food_record["food_id"]% 2 == 0){
                    /* checks if the vegetarian button is pressed */
                    if(array_key_exists('vegetarian', $_POST)){
                        if ($right_food_record['is_vegetarian'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($right_food_record);
                        }
                    }
                    /* checks if the vegan button is pressed */
                    elseif(array_key_exists('vegan', $_POST)){
                        if ($right_food_record['is_vegan'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($right_food_record);
                        }
                    }
                    /* checks if the dairy free button is pressed */
                    elseif(array_key_exists('dairy', $_POST)){
                        if ($right_food_record['is_dairy_free'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($right_food_record);
                        }
                    }
                    /* checks if the gluten-free button is pressed */
                    elseif(array_key_exists('gluten', $_POST)){
                        if ($right_food_record['is_gluten_free'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($right_food_record);
                        }
                    }
                    /* checks if the contains meat button is pressed */
                    elseif(array_key_exists('meat', $_POST)){
                        if ($right_food_record['is_meat'] == 'yes'){
                            /* runs function */
                            print_diet_food_info($right_food_record);
                        }
                    }
                    /* checks if the all food button is pressed */
                    elseif(array_key_exists('all_food', $_POST)){
                        /* runs function */
                        print_food_info($right_food_record);
                    }
                    else{
                        /* runs function */
                        print_food_info($right_food_record);
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