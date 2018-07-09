<!DOCTYPE html>
<html>

<?php

    //Session start initiated on top of the page
    session_start();
    $_SESSION['array'] = $data;

    //Included header tag
    include 'headers.php';
?>

<body class="bg-light">

<div class="wrapper">

    <!-- Navigation Side bar-->
    <?php include 'navSideBar.php';?>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-default">
                    <i class="fas fa-align-justify"></i>
                </button>

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <h2><strong>&nbsp;&nbsp;&nbsp;College of Architecture and Design </strong></h2>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class="nav-link" href="#">Check Balance Due |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register for Classes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Homepage main body starts from here -->
            <h4 class="text-danger".text-danger>Pricing Information and Dates for 2018</h4><hr></br>

            <div class="dropdown">

                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Browse Courses                      --
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?page=homepage&action=show">Architecture and Interiors</a>
                        <a class="dropdown-item" href="index.php?page=homepage&action=showDesign">Design + Make</a>
                    </div>
                </div>

            </div>
            <br>

            <h4 class="text-danger".text-danger> <?php
                foreach ($data as $row) {
                    echo $row['Description'];
                    break;
                }?> </h4>
            <hr>

            <?php
                //Print HTML Table
                print utility\htmlTable::genarateTableForCourses($data);
            ?>

            </br>
            <a class="btn btn-primary" href="index.php?page=homepage&action=registerArchitecture" role="button">Register for Courses</a>
    </div>

</div>

<div class="overlay"></div>

<!--Included javascript code for event click-->
<?php include 'footer.php';?>

</body>
</html>