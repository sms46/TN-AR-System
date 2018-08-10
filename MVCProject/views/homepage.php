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

                <a style="font-size: xx-large" href="index.php"><h2>&nbsp;&nbsp;&nbsp;<span class="badge badge-light">College of Architecture and Design</span></h2></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalCheckBalance"><h5><span class="badge badge-light">Check Balance Due</span></h5></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?page=homepage&action=registerArchitecture"><h5><span class="badge badge-light">Register</span></h5></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalSignIn"><h5><span class="badge badge-primary">Sign In</span></h5></a>
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

                    <!-- Sign In Modal -->
                    <div class="modal" id="modalSignIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">SIGN IN AS AN:</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card bg-light mb-3 shadow-lg p-3 mb-2 bg-white rounded">
                                                <div class="card-body text-center">
                                                    <a href="#"><h4><span class="text-primary" data-toggle="modal" data-target="#modalLogIn">ADMIN</span></h4></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card bg-light mb-3 shadow-lg p-3 mb-2 bg-white rounded">
                                                <div class="card-body text-center">
                                                    <a href="#"><h4><span class="text-primary">USER</span></h4></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Log In Modal -->
                    <div class="modal fade" id="modalLogIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-login" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">LOGIN</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="index.php?page=homepage&action=validateLogin" method="POST">
                                        <div class="form-group">
                                            <i class="fa fa-user"></i><input type="text" class="form-control" placeholder="Username" required="required">
                                        </div>
                                        <div class="form-group">
                                            <i class="fa fa-lock"></i>
                                            <input type="password" class="form-control" placeholder="Password" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Sign In">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!--Homepage main body starts from here -->
        <h4 class="text-danger".text-danger>Pricing Information and Dates for 2018</h4><hr></br>

        <div class="dropdown">

            <div class="btn-group">
                <button  class="btn btn-outline-primary dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Browse Courses &nbsp; &nbsp; &nbsp;
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
        <a class="btn btn-outline-primary" href="index.php?page=homepage&action=registerArchitecture" role="button">Register for Courses</a>

    </div>

</div>

<div class="overlay"></div>


<!--Included javascript code for event click-->
<?php include 'footer.php';?>

</body>
</html>