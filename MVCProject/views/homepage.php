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
            <h2><span class="badge badge-primary">Pricing Information and Dates for <?php print $currentYear;?></span></h2>
            <hr>

            <?php
                $value = $_POST['appName'];
                switch ($value) {
                    case "COAD":?>
                        <h5 class="text-danger" .text-dark> <?php print $_POST['courseOne']; ?> </h5>
                        <?php
                            $arcRecords = courses::findArchitectureCourses();

                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($arcRecords);
                        ?>

                        <hr>
                        <h5 class="text-danger" .text-dark> <?php print $_POST['courseTwo']; ?> </h5>

                        <?php
                            $desRecords = courses::findDesignCourses();

                            //Print HTML Table
                            print utility\htmlTable::generateTableForCourses($desRecords);
                        ?>

                         </br>
                         <a class="btn btn-outline-primary" href="index.php?page=homepage&action=redirectToCourse" role="button">Register for Courses</a>

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