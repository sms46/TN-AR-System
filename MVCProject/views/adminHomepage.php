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

    <!--<script>
        $(function() {
            $('.dates #usr1').datepicker({
                'format': 'yyyy-mm-dd',
                'autoclose': true
            });
        });
    </script>-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var d = new Date();
            for (var i = 0; i <= 10; i++) {
                var option = "<option value=" + parseInt(d.getFullYear() + i) + ">" + parseInt(d.getFullYear() + i) + "</option>"
                $('[id*=DropDownList1]').append(option);
            }
        });

        //Modal Width control for price type
        .modal-lg {
            max-width: 10%;
        }
    </script>

</head>

<?php
    //Retrieve the site id passed on
    $appId = $data;
    $productNames = products::getProductName($appId);
?>

<body >
<!-- Navigation Bar-->
<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="flex-row d-flex">
        <button type="button" class="navbar-toggler mr-2 " data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Welcome</a>
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
                <a class="nav-link" href="index.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

<!--Main Body -->
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">

        <!--Nav Side Bar-->
        <div class="col-md-3 col-lg-2 sidebar-offcanvas bg-light pl-0" id="sidebar" role="navigation">
            <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Reports▾</a>
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalExportStudentInfo">Student Info</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalExportCourseInfo">Course Info</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalExportOrderInfo">Student Order Info</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Grant Access</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalAddProducts">Add Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalAddPriceType">Add Price Type</a></li>
            </ul>
        </div>
        <!--/col-->

        <!--Export Data Modals-->
        <!-- 1. Student Info-->
        <div class="modal" id="modalExportStudentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export Student Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="index.php?page=adminHomepage&action=exportStudentInfo" method="post">
                        <div class="modal-body">


                            <label for="statusTypeSelect">Select Status:</label>
                            <select id="statusTypeSelect" name="statusTypeSelect" required>
                                <option value=""></option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>

                            <label for="DropDownList1">Select Year:</label>
                            <select id="DropDownList1" name="DropDownList1"></select>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="btnExport" type="submit" name="btnExport" class="btn btn-success clearfix">
                                <i class="far fa-file-excel" style="font-size:24px;"></i>&nbsp; Export to Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 2. Student-Course Info-->
        <div class="modal" id="modalExportCourseInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export Student Course Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="index.php?page=adminHomepage&action=export" method="post">
                        <div class="modal-body">


                            <label for="statusTypeSelect">Select Status:</label>
                            <select id="statusTypeSelect" name="statusTypeSelect" required>
                                <option value=""></option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>

                            <label for="DropDownList1">Select Year:</label>
                            <select id="DropDownList1" name="DropDownList1"></select>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="btnExport" type="submit" name="btnExport" class="btn btn-success clearfix">
                                <i class="far fa-file-excel" style="font-size:24px;"></i>&nbsp; Export to Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. Student-Order Info-->
        <div class="modal" id="modalExportOrderInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export Student Order Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="index.php?page=adminHomepage&action=export" method="post">
                        <div class="modal-body">


                            <label for="statusTypeSelect">Select Status:</label>
                            <select id="statusTypeSelect" name="statusTypeSelect" required>
                                <option value=""></option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>

                            <label for="DropDownList1">Select Year:</label>
                            <select id="DropDownList1" name="DropDownList1"></select>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="btnExport" type="submit" name="btnExport" class="btn btn-success clearfix">
                                <i class="far fa-file-excel" style="font-size:24px;"></i>&nbsp; Export to Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 4. Add products-->
        <div class="modal" id="modalAddProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="index.php?page=adminHomepage&action=addProducts" method="post">
                        <div class="modal-body">

                            Name:  <input type="text" class="form-control" name="productName" placeholder="Enter Product Name" required/><br/>
                            Category:  <input type="text" class="form-control" name="category" placeholder="Enter Category" required/><br/>
                            Description:  <input type="text" class="form-control" name="desc" placeholder="Enter Description" required/><br/>
                            Total: <input type="text" class="form-control" name="total" placeholder="Enter Total Count" required/><br/>
                            Sort ID: <input type="text" class="form-control" name="sort" placeholder="Enter Sort ID " required/><br/>

                            <div class="form-group">
                                <select class=" form-control" id="addDropDown" name="addDropDown" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="btnAdd" type="submit" name="btnAdd" class="btn btn-success clearfix">Add Product</button>
                            <input type="hidden" name="appId" value="<?php print $appId ?>"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 5. Add price type-->
        <div class="modal" id="modalAddPriceType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Price Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="index.php?page=adminHomepage&action=addPriceType" method="post">
                        <div class="modal-body">

                            Price Type:  <input type="text" class="form-control" name="priceType" placeholder="Enter Price Type" required/><br/>
                            Price: <input type="text" class="form-control" name="price" placeholder="Enter Price" required/><br/>

                            Select Products:
                                <select class="btn btn-default dropdown-toggle form-control rounded" name="productDropDown" required>
                                    <?php for($i=0; $i< count($productNames); $i++) {?>
                                        <option value="<?php print $productNames[$i]->id?>"><?php print $productNames[$i]->name. ' - (' .$productNames[$i]->description . ' )' ?></option>
                                    <?php } ?>
                                </select>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button id="btnAdd" type="submit" name="btnAddPrice" class="btn btn-success clearfix">Add Price Type</button>
                            <input type="hidden" name="appId" value="<?php print $appId ?>"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Registration Details-->
        <div class="col main pt-5 mt-3">

            <?php
                // Get the Application name based on site id
                $appOut = appConfig::getAppName($appId);
                $titleName = $appOut[0]->app_name;
            ?>

            <h1 class="display-4 d-none d-sm-block">
                <!-- Print the title Name -->
                <?php print $titleName ?>
            </h1>

            <p class="lead d-none d-sm-block">This is Admin Dashboard</p>

            <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>This is the admin page.</strong>
            </div>

            <!--Cards Display-->
            <div class="row mb-3">
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase" align="center">Registered Students</h6>
                            <h1 align="center"><a class="display-4 text-white" href="index.php?page=adminHomepage&action=viewRegistrations"><?php  $resultSet = studentOrderInfo::getRegisteredStudentInfo(); print count($resultSet)?></a></h1>

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
                            <h1 align="center"><a class="display-4 text-white" href="index.php?page=adminHomepage&action=viewPartialPayment"><?php $result = studentOrderInfo::getPartialPayment();print count($result)?></a></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <i class="fas fa-book fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase" align="center">Courses</h6>
                            <h1 align="center"><a class="display-4 text-white" href="index.php?page=adminHomepage&action=viewCourses"><?php //$course = studentOrderInfo::getCoursesAdmin();print count($course)?></a></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body  bg-primary">
                            <div class="rotate">
                                <i class="fas fa-book fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase" align="center">Student Course Info</h6>
                            <h1 align="center"><a class="display-4 text-white" href="index.php?page=adminHomepage&action=viewCoursesInfo"><?php //$course = studentOrderInfo::getCoursesInfoAdmin();print count($course)?></a></h1>
                        </div>
                    </div>
                </div>
            </div>

            <!--/row-->

            <hr>

            <!--<form action="index.php?page=adminHomepage&action=export" method="POST">
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
             <hr>-->

            <div class="row my-4">
                <div class="col-lg-10 col-md-8 table-responsive">
                    <?php
                        //to-do: Fetch the app id dynamically for title on homepage
                        $resultSet = studentOrderInfo::getRegisteredStudentInfo();
                        //Print HTML Table
                        print utility\htmlTable::generateTableForTest($productNames);
                    ?>

                </div>
            </div class="col-lg-4 col-md-4">

        </div><!--/row-->

    </div>
    <!--/main col-->
</div>

<!--scripts loaded here-->
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>



</body>
</html>