<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>NJIT Registrations</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Ajax Library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css" />

    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css" >

    <script>
        $(function() {
            $('.dates #usr1').datepicker({
                'format': 'yyyy-mm-dd',
                'autoclose': true
            });
        });
    </script>

</head>

<body >
<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="flex-row d-flex">
        <button type="button" class="navbar-toggler mr-2 " data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Welcome User</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#myAlert" data-toggle="collapse">Alert</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" data-target="#myModal" data-toggle="modal">Log Out</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-md-3 col-lg-2 sidebar-offcanvas bg-light pl-0" id="sidebar" role="navigation">
            <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Reports▾</a>
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="">Student Info</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Course Info</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Student Order Info</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Grant Access</a></li>
            </ul>
        </div>
        <!--/col-->

        <div class="col main pt-5 mt-3">
            <h1 class="display-4 d-none d-sm-block">
                College of Architecture and Design
            </h1>
            <p class="lead d-none d-sm-block">This is User Dashboard</p>

            <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>This is the admin page.</strong>
            </div>
            <div class="row mb-3">
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase" align="center">Registered Students</h6>
                            <h1 align="center"><a class="display-4 text-white" href="index.php?page=adminHomepage&action=viewRegistrations"><?php print count($data)?></a></h1>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fas fa-file-invoice-dollar fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase" align="center">Partial Payment</h6>
                            <h1 class="display-4" align="center">87</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <i class="fas fa-file-invoice-dollar fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase" align="center">Full Payment</h6>
                            <h1 class="display-4" align="center">125</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body  bg-primary">
                            <div class="rotate">
                                <i class="fas fa-book fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase" align="center">Courses</h6>
                            <h1 class="display-4" align="center">5</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

            <hr>

           <form action="index.php?page=adminHomepage&action=export" method="POST">
               <h4>Export data</h4>
                <div class="row mb-3">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="dates" style="margin-top:10px;color:#2471a3;">
                        <label>Start Date:</label>
                        <span class="far fa-calendar-alt"></span>
                        <input type="text" style="background-color:#aed6f1;" class="form-control" id="usr1" name="event_startDate" placeholder="YYYY-MM-DD" autocomplete="off" required>

                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="dates" style="margin-top:10px;color:#2471a3;">
                        <label>End Date:</label>
                        <span class="far fa-calendar-alt"></span>
                        <input type="text" style="background-color:#aed6f1;" class="form-control" id="usr1" name="event_endDate" placeholder="YYYY-MM-DD" autocomplete="off" >
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="dates" style="margin-top:40px;color:#2471a3;">
                    <button id="btnExport" type="submit" name="btnExport" class="btn btn-success clearfix">
                        <i class="far fa-file-excel" style="font-size:24px;"></i>&nbsp; Export to Excel</button>
                    </div>
                </div>
                &nbsp;
            </form>


            <hr>

           <?php //if(isset($_POST["add_to_cart"])) {?>
            <div class="row my-4">
                <div class="col-lg-10 col-md-8 table-responsive">
                    <?php
                        //Print HTML Table
                        print utility\htmlTable::generateTableForAdmin($data);
                    ?>

                </div>
            </div class="col-lg-4 col-md-4">

        </div><!--/row-->

    </div>
        <!--/main col-->
</div>

<!-- Modal -->
 <!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Log Out</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>This is a dashboard layout for Bootstrap 4. This is an example of the Modal component which you can use to show content.
                    Any content can be placed inside the modal and it can use the Bootstrap grid classes.</p>
                <p>
                    <a href="https://www.codeply.com/go/KrUO8QpyXP" target="_ext">Grab the code at Codeply</a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-outline" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>-->


<!--scripts loaded here-->
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>



</body>
</html>