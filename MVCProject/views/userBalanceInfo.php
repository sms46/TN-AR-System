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

                <a style="font-size: xx-large" href="index.php"><h2>&nbsp;&nbsp;&nbsp;<span class="badge badge-light">College of Architecture and Design</span></h2></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                    </ul>
                </div>
            </div>
        </nav>

        <h3 class="text-danger".text-danger align="center"><strong>USER PROFILE</strong></h3><hr></br>

        <div class="container" style="width:1400px;">
            <div class="row">
                <div class="col-md-5 order-md-3 mb-3 shadow-lg p-3 mb-5 bg-white rounded ">

                    <h4 align="center" class="text-primary">Balance Info</h4><hr>
                    <h4 class="list-group-item d-flex justify-content-between">
                        <span class="badge badge-pill badge-primary">Courses Taken</span>
                    </h4>

                    <ul class="list-group mb-3">
                        <?php  for ($i=0; $i< count($data); $i++){?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $data[$i]->course;?></h6>
                                    <small class="text-muted"><?php echo $data[$i]->startDate;?></small>
                                </div>
                            </li>
                        <?php }?>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total Amount(USD)</span>
                            <strong><?php print '$'. $data[0]->courseAmt?></strong>
                        </li>

                        <br><br>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Payment Type Selected</h6>
                                <small class="text-muted"><em><?php print $data[0]->paymentType?></em></small>
                            </div>
                        </li>

                        <!-- Commented the Amount Paid so that user is not confused,
                             Amount paid is updated in the DB though-->
                       <!-- <li class="list-group-item d-flex justify-content-between">
                            <span>Total Amount Paid(USD)</span>
                            <strong>
                                <?php
                                    //print '$'. $data[0]->amtPaid?>
                            </strong>
                        </li>-->

                        <br><br>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Remaining Balance Due</h6>
                            </div>
                            <span class="text-danger">
                                <strong>
                                    <?php print '$'. $data[0]->dueAmt?>
                                </strong>
                            </span>

                        </li>

                        <hr class="mb-4">
                            <form action="https://test.secure.touchnet.net:8443/C20146test_upay/web/index.jsp" method="POST">

                                <?php
                                $passedAmt = '87ABD23777';
                                $validationKeyString = $passedAmt .$data[0]->orderNum .$data[0]->dueAmt;
                                $hashedValidationKey = studentInfo::getHash($validationKeyString);
                                ?>

                                <button class="btn btn-primary btn-lg btn-block" name="btnPayment" type="submit" <?php if ($data[0]->dueAmt == '0'){ ?> disabled <?php } ?> >Continue to Pay </button>
                                <input type="hidden" name="UPAY_SITE_ID" value="8">
                                <input type="hidden" name="AMT" value="<?php print $data[0]->dueAmt ?>">
                                <input type="hidden" name="EXT_TRANS_ID" value="<?php print $data[0]->orderNum ?>">
                                <input type="hidden" name="VALIDATION_KEY" value="<?php print $hashedValidationKey ?>">
                                <!--<input type="hidden" name="EXT_TRANS_ID_LABEL" value="Your Invoice Number is:">
                                <input type="hidden" name="SUCCESS_LINK_TEXT" value="Click here to confirm your payment.">
                                <input type="hidden" name="SUCCESS_LINK" size="10" value="">
                                <input type="hidden" name="ERROR_LINK_TEXT" size="10" value="New Error Link Text">
                                <input type="hidden" name="ERROR_LINK" size="10" value="">
                                <input type="hidden" name="CANCEL_LINK_TEXT" size="10" value="New Cancel Link Text">
                                <input type="hidden" name="CANCEL_LINK" size="10" value="">-->
                            </form>
                    </ul>
                </div>

                <div class="col-md-7 order-md-1">
                    <div class="card shadow-lg p-3 mb-1 bg-white rounded">
                        <p class="card-body">
                            <p class="card-title"><h2><span class="badge badge-primary">STUDENT INFORMATION</span></h2></p>

                            <p class="card-text">
                                <div class="row">
                                    <div class="col-md-5 mb-2">
                                        <h4><span class="badge badge-secondary">Student's Full Name :</span></h4>
                                        <h5><span class="badge badge-light"><?php print $data[0]->studentName?></span></h5>
                                    </div>

                                    <div class="col-md-5 mb-2">
                                        <h4><span class="badge badge-secondary">Email :</span></h4>
                                        <h5><span class="badge badge-light"><?php print $data[0]->studentEmail?></span></h5>
                                    </div>
                                </div>

                                <br>
                                <p class="card-title"><h2><span class="badge badge-primary">ADDRESS</span></h2></p>

                                <div class="row">
                                    <div class="col-md-5 mb-2">
                                        <h4><span class="badge badge-secondary">Street Address :</span></h4>
                                        <h5><span class="badge badge-light"><?php print $data[0]->streetAddress?></span></h5>
                                    </div>

                                    <div class="col-md-5 mb-2">
                                        <h4><span class="badge badge-secondary">City :</span></h4>
                                        <h5><span class="badge badge-light"><?php print $data[0]->city?></span></h5>
                                    </div>

                                    <div class="col-md-5 mb-2">
                                        <h4><span class="badge badge-secondary">State :</span></h4>
                                        <h5><span class="badge badge-light"><?php print $data[0]->state?></span></h5>
                                    </div>

                                    <div class="col-md-5 mb-2">
                                        <h4><span class="badge badge-secondary">Zip Code :</span></h4>
                                        <h5><span class="badge badge-light"><?php print $data[0]->zipCode?></span></h5>
                                    </div>

                                </div>
                            </p>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--Included javascript code for event click-->
<?php include 'footer.php';?>

</body>
</html>