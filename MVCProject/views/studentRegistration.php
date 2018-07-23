<!DOCTYPE html>
<html>

<?php

    //Included header tag
    include 'headers.php';
?>

<div class="wrapper">

    <!-- Navigation Side bar-->
    <?php include 'navSideBar.php';?>

    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-default">
                    <i class="fas fa-align-justify"></i>
                </button>

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <a style="font-size: xx-large" href="index.php"><strong>&nbsp;&nbsp;&nbsp;College of Architecture and Design</strong></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                    </ul>
                </div>
            </div>
        </nav>

        <h3 class="text-danger".text-danger align="center"><strong>COURSE CHECKOUT</strong></h3><hr></br>

        <div class="row">
             <div class="col-md-4 order-md-2 mb-4 shadow-lg p-3 mb-5 bg-white rounded ">

                    <h4 align="center" class="text-primary">Order No: <?php echo $data ?></h4><hr>
                    <h4 class="list-group-item d-flex justify-content-between">
                        <span class="text-primary">STEP 2:</span>
                        <span class="badge badge-pill badge-primary">Your Courses - <?php print count($_SESSION['cart_item'])?></span>
                    </h4>

             <ul class="list-group mb-3">
                <?php foreach($_SESSION['cart_item'] as $key=>$item):?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $item["Description"];?></h6>
                            <small class="text-muted"><?php echo $item["StartDate"]. '-' .$item["EndDate"] ;?></small>
                        </div>
                        <span class="text-muted"><?php echo '$'. $item["Price"];?></span>
                    </li>
                <?php endforeach;?>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total Amount(USD)</span>
                    <strong><?php print '$'. $_REQUEST["totalAmt"]?></strong>
                </li>

                <br><br>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Payment Type Selected</h6>

                        <?php
                        $paymentTypeAmt = null;
                        $paymentTypeSelect = null;
                        if($_POST["paymentTypeSelect"] == 'Deposit'){
                            $paymentTypeAmt = 200;
                            $paymentTypeSelect = 'Deposit';
                        }
                        elseif ($_POST["paymentTypeSelect"] == 'Full Payment'){
                            $paymentTypeAmt = $_REQUEST["totalAmt"] - (0.1 * $_REQUEST["totalAmt"]);
                            $paymentTypeSelect = 'Full Payment - (10% discount applied)';
                        }
                        ?>
                        <small class="text-muted"><em><?php echo $paymentTypeSelect?></em></small>
                    </div>
                    <span class="text-muted"><?php echo '$'. $paymentTypeAmt;?></span>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Application Fee</h6>
                        <small class="text-muted"><em>(Non-refundable)</em></small>
                    </div>
                    <span class="text-muted">
                        <?php
                        $applicationAmt = 40;
                        echo '$' .$applicationAmt;
                        ?>
                    </span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total Amount Due(USD)</span>
                    <strong>
                        <?php
                        $finalAmt = $paymentTypeAmt + $applicationAmt;
                        print '$'. $finalAmt?>
                    </strong>
                </li>

                <br><br>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Remaining Balance Due</h6>
                        <small class="text-muted"><em>Amount to be paid later</em></small>
                    </div>
                    <span class="text-muted">
                        <?php
                        $balanceAmt = 0;
                        if($_POST["paymentTypeSelect"] == 'Deposit'){
                            $balanceAmt = $_REQUEST["totalAmt"] - $finalAmt;
                            echo '$' .$balanceAmt;
                        }
                        elseif ($_POST["paymentTypeSelect"] == 'Full Payment'){
                            echo '$' .$balanceAmt;
                        }

                        ?>
                    </span>
                </li>

                <hr class="mb-4">
                <form action="https://test.secure.touchnet.net:8443/C20146test_upay/web/index.jsp" method="POST">

                    <?php
                        $passedAmt = '87ABD23777';
                        $validationKeyString = $passedAmt .$data .$finalAmt;
                        $hashedValidationKey = studentInfo::getHash($validationKeyString);
                    ?>

                    <button class="btn btn-primary btn-lg btn-block" name="btnPayment" type="submit">Continue to Pay <?php echo '$'. $finalAmt?></button>
                    <input type="hidden" name="UPAY_SITE_ID" value="8">
                    <input type="hidden" name="AMT" value="<?php print $finalAmt ?>">
                    <input type="hidden" name="EXT_TRANS_ID" value="<?php print $data ?>">
                    <input type="hidden" name="VALIDATION_KEY" value="<?php print $hashedValidationKey ?>">
                    <input type="hidden" name="EXT_TRANS_ID_LABEL" value="Your Invoice Number is:">
                    <input type="hidden" name="SUCCESS_LINK_TEXT" value="Click here to confirm your payment.">
                    <input type="hidden" name="SUCCESS_LINK" size="10" value="">
                    <input type="hidden" name="ERROR_LINK_TEXT" size="10" value="New Error Link Text">
                    <input type="hidden" name="ERROR_LINK" size="10" value="">
                    <input type="hidden" name="CANCEL_LINK_TEXT" size="10" value="New Cancel Link Text">
                    <input type="hidden" name="CANCEL_LINK" size="10" value="">
                </form>
             </ul>
             </div>

             <div class="col-md-8 order-md-1 ">
                    <h3 class="mb-3 text-primary">STEP 1: STUDENT INFORMATION</h3> <hr>
                    <form action="index.php?page=studentRegistration&action=storeStudentInfo" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="studentName">Student's Full Name</label>
                                <input type="text" class="form-control" name="studentName" placeholder="Enter Student's Full Name" value="" required>
                                <div class="invalid-feedback">
                                    Your Full Name is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="email">Email </label>
                                <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="parentName">Parent/Guardian Name</label>
                                <input type="text" class="form-control" name="parentName" placeholder="Enter Parent/Guardian Name" value="" required>
                                <div class="invalid-feedback">
                                    Your Parent/Guardian Name is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="highSchool">High School </label>
                                <input type="text" class="form-control" name="highSchool" placeholder="Enter High School" required>
                                <div class="invalid-feedback">
                                    Your High School Name is required.
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <h3 class="mb-3 text-primary">ADDRESS</h3><hr>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="streetAddress">Street Address</label>
                                <input type="text" class="form-control" name="streetAddress" placeholder="Enter Street Address" value="" required>
                                <div class="invalid-feedback">
                                    Street Address is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" placeholder="Enter City" required>
                                <div class="invalid-feedback">
                                    City Name is required.
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="state">State</label>
                                <input type="text" class="form-control" name="state" placeholder="Enter State" value="" required>
                                <div class="invalid-feedback">
                                    State Name is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="zipCode">Zip Code</label>
                                <input type="text" class="form-control" name="zipCode" placeholder="Enter Zip Code" required>
                                <div class="invalid-feedback">
                                    Zip Code is required.
                                </div>
                            </div>
                        </div>

                        <br>
                        <button type="submit" name="save_details" class="btn btn-primary">Save Details</button>
                        <input type="hidden" name="totalAmtPaid" value= "<?php print $finalAmt ?>" >
                        <input type="hidden" name="totalAmt" value= "<?php print $_REQUEST["totalAmt"] ?>" >
                        <input type="hidden" name="paymentTypeSelect" value= "<?php print $_POST["paymentTypeSelect"]?>" >
                        <input type="hidden" name="orderNum" value= "<?php print $data ?>" >
                        <input type="hidden" name="courseAmt" value= "<?php print $_REQUEST["totalAmt"]?>" >
                        <input type="hidden" name="dueAmt" value= "<?php print $balanceAmt ?>" >
                    </form>
             </div>
        </div>
    </div>
</div>

<!--Included javascript code for form Validation-->
<?php include 'formValidation.php';?>

<!--Included javascript code for event click-->
<?php include 'footer.php';?>

</body>
</html>