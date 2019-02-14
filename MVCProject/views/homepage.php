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
    <?php include 'navSideBar.php';?>

    <!-- Page Content  -->
    <div id="content">

        <!-- Navigation bar-->
        <?php include 'navBar.php';?>

        <div class="container">
            <!--Homepage main body starts from here -->

            <?php $currentYear = studentCourseInfo::getCurrentYear();?>
            <h2>Pricing Information and Dates for <?php print $currentYear;?></h2>
            <!--<h2><span class="badge badge-dark">Pricing Information and Dates for <?php print $currentYear;?></span></h2>-->
            <hr>

            <?php
                //$value = $_REQUEST['appName'];
            $value = 'COAD';
                switch ($value) {
                    case "COAD":

                        $arcRecords = courses::findArchitectureCourses();
                        $desRecords = courses::findDesignCourses();
                        $interiorRecords = courses::findInteriorCourses();
                        $graphDesRecords = courses::findGraphicDesignCourses();
                        $digitDesRecords = courses::findDigitalDesignCourses();

                        ?>

                    <!--Only Pass Active Courses to HTML Table,
                          if array is empty continue without display-->
                        <?php if(!empty($arcRecords)) { ?>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($arcRecords); ?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($arcRecords);}?>

                        <?php if(!empty($desRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($desRecords); ?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($desRecords);}?>

                        <?php if(!empty($interiorRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($interiorRecords);?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($interiorRecords);}?>

                        <?php if(!empty($graphDesRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($graphDesRecords); ?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($graphDesRecords);}?>

                        <?php if(!empty($digitDesRecords)) { ?>

                                <hr>
                                <h4 class="text-danger"> <?php print utility\getTitle::getTitleForCourses($digitDesRecords);?> </h4>
                                <?php
                                    //Print HTML Table
                                    print utility\htmlTable::generateTableForCourses($digitDesRecords);}?>

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