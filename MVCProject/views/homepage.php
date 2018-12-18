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
            <h2><span class="badge badge-dark">Pricing Information and Dates for <?php print $currentYear;?></span></h2>
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


                        <h4 class="text-danger" .text-dark> <?php print utility\getTitle::getTitleForCourses($arcRecords);?> </h4>
                        <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($arcRecords);
                        ?>

                        <hr>
                        <h4 class="text-danger" .text-dark> <?php print utility\getTitle::getTitleForCourses($desRecords);?> </h4>

                        <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($desRecords);
                        ?>

                        <hr>
                        <h4 class="text-danger" .text-dark> <?php print utility\getTitle::getTitleForCourses($interiorRecords);?> </h4>

                        <?php
                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($interiorRecords);
                        ?>

                        <hr>
                        <h4 class="text-danger" .text-dark> <?php print utility\getTitle::getTitleForCourses($graphDesRecords);?> </h4>

                        <?php
                        //Print HTML Table
                        print utility\htmlTable::generateTableForCourses($graphDesRecords);
                        ?>

                        <hr>
                        <h4 class="text-danger" .text-dark> <?php print utility\getTitle::getTitleForCourses($digitDesRecords);?> </h4>

                        <?php
                        //Print HTML Table
                        print utility\htmlTable::generateTableForCourses($digitDesRecords);
                        ?>

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