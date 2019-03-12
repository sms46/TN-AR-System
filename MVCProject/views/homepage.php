<!DOCTYPE html>
<html>

<?php

//Session start initiated on top of the page
session_start();

//Included header tag
include 'headers.php';

?>

<body class="bg-light">

<div class="wrapper">

    <!-- Navigation Side bar-->
    <?php // include 'navSideBar.php';?>

    <!-- Page Content  -->
    <div id="content">

        <!-- Navigation bar-->
        <?php include 'navBar.php';?>

        <div class="container">
            <!--Homepage main body starts from here -->

            <?php

            // Get the current calender year
            $currentYear = studentCourseInfo::getCurrentYear();

            //Retrieve the site id passed on in the URL
            $appId = $_REQUEST['id'];

            // Get the Application name based on site id
            $appOut = appConfig::getAppName($appId);
            $value = $appOut[0]->app_code;

                switch ($value) {
                    case "COAD":?>

                        <h2>Pricing Information and Dates for <?php print $currentYear;?></h2>
                        <hr>

                        <?php
                            $arcRecords = courses::findArchitectureCourses();
                            $desRecords = courses::findDesignCourses();
                            $interiorRecords = courses::findInteriorCourses();
                            $graphDesRecords = courses::findGraphicDesignCourses();
                            $digitDesRecords = courses::findDigitalDesignCourses();

                            //Get Prices for Residential and Commuter
                            $strResPrice = coursePrice::getResidentPrice();
                            $resPrice = $strResPrice[0]->price;

                            $strCommPrice = coursePrice::getCommuterPrice();
                            $commPrice = $strCommPrice[0]->price;
                        ?>

                    <!--Only Pass Active Courses to HTML Table,
                          if array is empty continue without display-->
                        <?php if(!empty($arcRecords)) { ?>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($arcRecords); ?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($arcRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($desRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($desRecords); ?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($desRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($interiorRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($interiorRecords);?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($interiorRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($graphDesRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($graphDesRecords); ?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($graphDesRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($digitDesRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($digitDesRecords);?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($digitDesRecords,$resPrice,$commPrice);}?>

                         </br>
                         <form action="index.php?page=homepage&action=redirectToCourse" method="POST">
                             <button class="btn btn-outline-primary" name="btnRegister" type="submit">Register for Courses</button>
                         </form>
                        <?php break;

                    case "YWCC":?>

                        <h2>Pricing Information and Dates for YWCC <?php print $currentYear;?></h2>
                        <hr>

                        <?php
                        $arcRecords = courses::findArchitectureCourses();
                        $desRecords = courses::findDesignCourses();
                        $interiorRecords = courses::findInteriorCourses();
                        $graphDesRecords = courses::findGraphicDesignCourses();
                        $digitDesRecords = courses::findDigitalDesignCourses();

                        //Get Prices for Residential and Commuter
                        $strResPrice = coursePrice::getResidentPrice();
                        $resPrice = $strResPrice[0]->price;

                        $strCommPrice = coursePrice::getCommuterPrice();
                        $commPrice = $strCommPrice[0]->price;
                        ?>

                        <!--Only Pass Active Courses to HTML Table,
                              if array is empty continue without display-->
                        <?php if(!empty($arcRecords)) { ?>
                            <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($arcRecords); ?> </h4>
                            <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($arcRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($desRecords)) { ?>

                            <hr>
                            <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($desRecords); ?> </h4>
                            <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($desRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($interiorRecords)) { ?>

                            <hr>
                            <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($interiorRecords);?> </h4>
                            <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($interiorRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($graphDesRecords)) { ?>

                            <hr>
                            <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($graphDesRecords); ?> </h4>
                            <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($graphDesRecords,$resPrice,$commPrice);}?>

                        <?php if(!empty($digitDesRecords)) { ?>

                            <hr>
                            <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($digitDesRecords);?> </h4>
                            <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($digitDesRecords,$resPrice,$commPrice);}?>

                        </br>
                        <form action="index.php?page=homepage&action=redirectToCourse" method="POST">
                            <button class="btn btn-outline-primary" name="btnRegister" type="submit">Register for Courses</button>
                        </form>
                        <?php break;

                        default:
                        echo "Error in code";
                } ?>
        </div>

    </div>

</div>

    <!--Overlay effect for modal-->
    <div class="overlay"></div>

    <!--Included javascript code for event click-->
    <?php include 'footer.php';?>

</body>
</html>