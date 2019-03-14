<!DOCTYPE html>
<html lang="en">

<?php
    //Included header tag
    include 'headers.php';
?>

<body class="bg-light">

<div class="wrapper">

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h3><span class="badge badge-danger">NJIT REGISTRATIONS</span></h3></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLogIn"><h5><span class="badge badge-dark">Log In</span></h5></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><br><br><br><br>

    <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row my-4">
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="https://parcoffice.com/wp-content/uploads/2017/10/njit-logo-red-fullres.png" alt="">
            </div>

            <div class="col-lg-5">
                <h3 align="center">WELCOME TO NJIT COURSE REGISTRATION</h3>
                <p align="center">This is the landing page for all the schools to register for their courses.</p>
            </div>

        </div>

        <br>
        <!-- Card Information-->
        <div class="card bg-light my-4 text-center">
            <div class="card-body">
                <h3><span class="badge badge-light">Please select the school below to register for your courses</span></h3>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <a href="index.php?page=homepage&action=redirectToCoad&id=1" onclick="document.getElementById('myform').submit();"><h2>College of Architecture and Design</h2></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <a href="index.php?page=homepage&action=redirectToCoad&id=2" onclick="document.getElementById('myform').submit();"><h2>Ying Wu School of Computing</h2></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">School of Management</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Overlay effect for modal-->
    <div class="overlay"></div>

    <!--Included javascript code for event click-->
    <?php include 'footer.php';?>

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
                    <form action="index.php?page=adminHomepage&action=validateLogin" method="POST">
                        <div class="form-group">
                            <i class="fa fa-user"></i><input type="text" class="form-control" placeholder="Username" name="userName" required="required">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                        </div>

                        <div class="form-group">
                            <select class=" form-control" id="adminDropDown" name="adminDropDown" required>
                                <option value="">Select a Department</option>
                                <option value="1">College of Architecture and Design</option>
                                <option value="2">Ying Wu School of Computing</option>
                            </select>
                            <i class="fas fa-chevron-circle-down"></i>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Sign In" name="btnSignIn">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                   <!-- <a href="#" align="left" >Forgot Password?</a>-->
                    <a href="#" align="right" data-toggle="modal" data-target="#modalSignIn">Request for an access</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign In Modal -->
    <div class="modal" id="modalSignIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-login" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">REQUEST ACCESS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="index.php?page=adminHomepage&action=createLogin" method="POST">
                        <div class="form-group">
                            <i class="fa fa-user"></i><input type="text" class="form-control" placeholder="Username" name="userName" required="required">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                        </div>

                        <div class="form-group">
                            <select class=" form-control" id="adminDropDown" name="adminDropDown" required>
                                <option value="">Select a Department</option>
                                <option value="1">College of Architecture and Design</option>
                                <option value="2">Ying Wu School of Computing</option>
                            </select>
                            <i class="fas fa-chevron-circle-down"></i>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-danger btn-block btn-lg" value="Request Access" name="btnRequest">
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                   <!-- <a href="#" align="left" >Forgot Password?</a>
                    <a href="#" align="right"</a>-->
                </div>

            </div>
        </div>
    </div>

</div>

</body>

</html>
