<!DOCTYPE html>
<html>

<?php
session_start(); // DO CALL ON TOP OF BOTH PAGES
$_SESSION['array'] = $data;
?>

<?php include 'headers.php';?>

<body>

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div id="dismiss">
            <!--<i class="fas fa-arrow-left"></i>-->
            <label> <strong>x</strong></label>
        </div>

        <div class="sidebar-header">
            <h6>College of Architecture and Design</h6>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Home 1</a>
                    </li>
                    <li>
                        <a href="#">Home 2</a>
                    </li>
                    <li>
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Services</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>

    </nav>

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

                <h1><strong>&nbsp;&nbsp;&nbsp;College of Architecture and Design </strong></h1>
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
            <h3 class="text-danger".text-danger>Pricing Information and Dates for 2018</h3><hr></br>

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
            print utility\htmlTable::genarateTableForCourses($data);
            ?>

            </br>
            <a class="btn btn-primary" href="index.php?page=homepage&action=registerArchitecture" role="button">Register for Courses</a>
    </div>

</div>

<div class="overlay"></div>

<?php include 'footer.php';?>

</body>
</html>