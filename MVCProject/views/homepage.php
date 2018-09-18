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

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-default">
                    <i class="fas fa-align-justify"></i>
                </button>

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <a style="font-size: xx-large" href="index.php"><h1>&nbsp;&nbsp;&nbsp;<span class="badge badge-light"><?php print $_POST['title'];?></span></h1></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalCheckBalance"><h5><span class="badge badge-light">Check Balance Due</span></h5></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?page=homepage&action=redirectToCourse"><h5><span class="badge badge-light">Register</span></h5></a>
                        </li>
                    </ul>

                    <!-- Check Balance Due Modal -->
                    <div class="modal" id="modalCheckBalance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Check Balance Due</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="index.php?page=homepage&action=checkBalance" method="post">
                                    <div class="modal-body">

                                        Student's Full Name: <input type="text" class="form-control" name="studentName" placeholder="Enter Student's Full Name" value="" required><br/>
                                        Email Address:  <input type="email" class="form-control" name="email" placeholder="you@example.com" required><br/>
                                        Order Number:  <input type="text" class="form-control" name="orderNo" placeholder="Enter your Order Number" required><br/>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Check" name="checkBalance" class="btn btn-success"</input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>

        <div class="container">
            <!--Homepage main body starts from here -->
            <h2><span class="badge badge-primary">Pricing Information and Dates for 2018</span></h2>
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
                         <a class="btn btn-outline-primary" href="index.php?page=homepage&action=redirectToCourse" role="button">Register or Courses</a>

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