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
            <h2>About Us</h2>
        </div>

        <!-- Text section class from style sheet -->
        <div class="grid-item home_text">
            <!-- Prints out text -->
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