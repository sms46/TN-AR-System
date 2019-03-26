<!DOCTYPE html>
<html>

<?php

    //Included header tag
    include 'headers.php';
    //Get values from the config File
    $configs = include('config.php');

?>

<div class="wrapper">

    <!-- Navigation Side bar-->
    <?php// include 'navSideBar.php';?>

    <div id="content">

        <!-- Navigation bar-->
        <?php include 'navBar.php';?>

        <div class="container">
            <h3 class="text-danger" align="center"><strong>CHECKOUT</strong></h3><hr/><br/>

            <?php if(isset($_POST["save_details"])) {?>
                <div class="alert alert-success" role="alert">
                    Student Information has been successfully saved. Please Proceed with the Payment !!
                </div>
            <?php } ?>

            <div class="row">

                <!-- Wilfred-NOTE: Do Not change the positions of the below div-->
                <!--Step 2: Order Cart-->
                <div class="col-md-5 order-md-3 mb-3 shadow-lg p-3 mb-5 bg-white rounded ">

                    <h4 align="center" class="text-primary">Order No: <?php echo $data ?></h4><hr>
                    <h4 class="list-group-item d-flex justify-content-between">
                        <span class="badge badge-pill badge-dark">STEP 2:</span>
                        <span class="badge badge-pill badge-dark">Total Products - <?php print count($_SESSION['cart_item'])?></span>
                    </h4>

                    <ul class="list-group mb-3">
                        <?php foreach($_SESSION['cart_item'] as $key=>$item):?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $item["Name"];?></h6>
                                    <small class="text-muted"><?php echo $item["Description"] ;?></small>
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
                                    //Get Deposit Amount from the config file
                                    $depositAmt = $configs->depositAmt;
                                    $paymentTypeAmt = $depositAmt * count($_SESSION['cart_item']);
                                    $paymentTypeSelect = 'Deposit: ($'.$depositAmt.' per course)';
                                }
                                elseif ($_POST["paymentTypeSelect"] == 'Full Payment'){
                                    //Get Discount Percent from the config file
                                    $discount = $configs->discountPer;
                                    $paymentTypeAmt = $_REQUEST["totalAmt"] - ($discount * $_REQUEST["totalAmt"]);
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
                            //Get Application Fee from the config file
                            $applicationAmt = $configs->appFee;
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
                                <h6 class="my-0">Remaining Balance (after payment)</h6>
                                <small class="text-muted"><em>Amount to be paid later</em></small>
                            </div>
                            <span class="text-danger">
                            <?php
                            $balanceAmt = 0;
                            if($_POST["paymentTypeSelect"] == 'Deposit'){
                                //Didn't include App Fee in the transaction
                                $balanceAmt = $_REQUEST["totalAmt"] - $paymentTypeAmt;
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


                            <?php if(isset($_POST["save_details"])) {
                                $appId = $_REQUEST['app_id'];
                                $appOut = appConfig::getAppName($appId);
                                $app_key = $appOut[0]->app_key;

                            //$passedAmt = '87ABD23777';
                            $validationKeyString = $app_key .$data .$finalAmt;
                            $hashedValidationKey = userInfo::getHash($validationKeyString);
                            } ?>

                            <?php if(isset($_POST["save_details"])) {
                                ?>
                                <button class="btn btn-primary btn-lg btn-block " name="btnPayment" type="submit">Continue to
                                    Pay <?php echo '$' . $finalAmt ?></button>

                                <?php
                            }
                            else{
                                ?>
                                <button class="btn btn-outline-primary btn-lg btn-block " name="btnPayment" type="submit" disabled>Continue to
                                    Pay <?php echo '$' . $finalAmt ?></button>
                                <?php
                            }
                            ?>
                            <input type="hidden" name="UPAY_SITE_ID" value="8"/>
                            <input type="hidden" name="AMT" value="<?php print $finalAmt ?>"/>
                            <input type="hidden" name="EXT_TRANS_ID" value="<?php print $data ?>"/>
                            <input type="hidden" name="VALIDATION_KEY" value="<?php print $hashedValidationKey ?>"/>
                            <input type="hidden" name="EXT_TRANS_ID_LABEL" value="Order:">
                            <!--<input type="hidden" name="SUCCESS_LINK_TEXT" value="">
                            <input type="hidden" name="SUCCESS_LINK" size="10" value="">
                            <input type="hidden" name="ERROR_LINK_TEXT" size="10" value="New Error Link Text">
                            <input type="hidden" name="ERROR_LINK" size="10" value="">
                            <input type="hidden" name="CANCEL_LINK_TEXT" size="10" value="New Cancel Link Text">
                            <input type="hidden" name="CANCEL_LINK" size="10" value="">-->
                        </form>
                    </ul>
                </div>

                <!--Step 1: Enter the User Information-->
                <div class="col-md-7 order-md-1 ">
                    <h2><span class="badge badge-pill badge-dark">STEP 1:</span>&nbsp;<span class="badge badge-pill badge-dark">USER INFORMATION</span></h2><br>

                    <form action="index.php?page=userRegistration&action=storeUserInfo" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-10 mb-2">
                                <h5><span class="badge badge-light">Student's Full Name :</span></h5>
                                <input type="text" class="form-control" name="studentName" placeholder="Enter Full Name" value="<?php if (isset($_POST['studentName'])) echo $_POST['studentName']; ?>" required/>
                                <div class="invalid-feedback">
                                    Your Full Name is required.
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">Email :</span></h5>
                                <input type="email" class="form-control" name="email" placeholder="you@example.com" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required/>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>

                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light"> Gender :</span></h5>
                                <input type="text" class="form-control" name="gender" placeholder="Enter Gender" value="<?php if (isset($_POST['gender'])) echo $_POST['gender']; ?>" required/>
                                <div class="invalid-feedback">
                                    Your gender is required.
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">High School :</span></h5>
                                <input type="text" class="form-control" name="highSchool" placeholder="Enter High School" value="<?php if (isset($_POST['highSchool'])) echo $_POST['highSchool']; ?>" required/>
                                <div class="invalid-feedback">
                                    Your High School Name is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">Graduation Year :</span></h5>
                                <input type="text" class="form-control" name="gradYear" placeholder="Graduation Year" value="<?php if (isset($_POST['gradYear'])) echo $_POST['gradYear']; ?>" required/>
                                <div class="invalid-feedback">
                                    Your Graduation Year is required.
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-10 mb-2">
                                <h5><span class="badge badge-light">Parent/Guardian Name :</span></h5>
                                <input type="text" class="form-control" name="parentName" placeholder="Enter Parent/Guardian Name" value="<?php if (isset($_POST['parentName'])) echo $_POST['parentName']; ?>" required/>
                                <div class="invalid-feedback">
                                    Your Parent/Guardian Name is required.
                                </div>
                            </div>
                        </div> <br>

                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">Parent/Guardian Email :</span></h5>
                                <input type="email" class="form-control" name="parentEmail" placeholder="Enter Parent/Guardian Email" value="<?php if (isset($_POST['parentEmail'])) echo $_POST['parentEmail']; ?>" required/>
                                <div class="invalid-feedback">
                                    Your Parent/Guardian Email is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">Parent/Guardian Number :</span></h5>
                                <input type="text" class="form-control" name="parentNumber" placeholder="Enter Phone Number" value="<?php if (isset($_POST['parentNumber'])) echo $_POST['parentNumber']; ?>" required/>
                                <div class="invalid-feedback">
                                    Your Parent/Guardian Number is required.
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h2><span class="badge badge-pill badge-dark">ADDRESS</span></h2><br>

                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">Street Address :</span></h5>
                                <input type="text" class="form-control" name="streetAddress" placeholder="Enter Street Address" value="<?php if (isset($_POST['streetAddress'])) echo $_POST['streetAddress']; ?>" required/>
                                <div class="invalid-feedback">
                                    Street Address is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">City :</span></h5>
                                <input type="text" class="form-control" name="city" placeholder="Enter City" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>" required/>
                                <div class="invalid-feedback">
                                    City Name is required.
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">State :</span></h5>
                                <input type="text" class="form-control" name="state" placeholder="Enter State" value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>" required/>
                                <div class="invalid-feedback">
                                    State Name is required.
                                </div>
                            </div>

                            <div class="col-md-5 mb-2">
                                <h5><span class="badge badge-light">Zip Code :</span></h5>
                                <input type="text" class="form-control" name="zipCode" placeholder="Enter Zip Code" value="<?php if (isset($_POST['zipCode'])) echo $_POST['zipCode']; ?>" required/>
                                <div class="invalid-feedback">
                                    Zip Code is required.
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <?php if(isset($_POST["save_details"])) {?>
                                    <button type="submit" name="save_details" class="btn btn-outline-primary btn-lg " disabled>Save Details</button>

                                    <?php
                                }else{
                                    ?>
                                    <button type="submit" name="save_details" class="btn btn-primary btn-lg ">Save Details</button>
                                    <?php
                                }
                                ?>

                                <input type="hidden" name="totalAmtPaid" value= "<?php print $finalAmt ?>" >
                                <input type="hidden" name="totalAmt" value= "<?php print $_REQUEST["totalAmt"] ?>" >
                                <input type="hidden" name="paymentTypeSelect" value= "<?php print $_POST["paymentTypeSelect"]?>" >
                                <input type="hidden" name="orderNum" value= "<?php print $data ?>" >
                                <input type="hidden" name="courseAmt" value= "<?php print $_REQUEST["totalAmt"]?>" >
                                <input type="hidden" name="dueAmt" value= "<?php print $balanceAmt ?>" >
                                <input type="hidden" name="app_id" value= "<?php print $_REQUEST["app_id"]?>" >
                            </div>
                        </div>

                    </form>
                </div>
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