<!DOCTYPE html>
<html>


<?php
//print_r($data);
//Included header tag
include 'headers.php';
?>

<div class="wrapper">

    <!-- Navigation Side bar-->
    <?php //include 'navSideBar.php';?>

    <div id="content">

        <!-- Navigation bar-->
        <?php include 'navBar.php';?>

        <h3 class="text-danger".text-danger align="center"><strong>USER PROFILE</strong></h3><hr/><br/>

        <div class="container" style="width:1400px;">
            <div class="row">
                <div class="col-md-5 order-md-3 mb-3 shadow-lg p-3 mb-5 bg-white rounded ">

                    <h4 align="center" class="text-dark">Balance Information</h4><hr/>
                    <h4 class="list-group-item d-flex justify-content-between">Products: </h4>

                    <ul class="list-group mb-3">
                        <?php  for ($i=0; $i< count($data); $i++){?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $data[$i]->name;?></h6>
                                    <small class="text-muted"><?php echo $data[$i]->description;?></small>
                                </div>
                            </li>
                        <?php }?>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total Amount(USD)</span>
                            <strong><?php print '$'. $data[0]->product_amt?></strong>
                        </li>

                        <!--<br><br>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Payment Type Selected</h6>
                                <small class="text-muted"><em><?php print $data[0]->payment_type?></em></small>
                            </div>
                        </li>-->

                        <br><br>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Remaining Balance Due</h6>
                            </div>
                            <span class="text-danger">
                                <strong>
                                    <?php print '$'. $data[0]->due_amt?>
                                </strong>
                            </span>
                        </li>

                        <hr class="mb-4">
                        <form action="https://test.secure.touchnet.net:8443/C20146test_upay/web/index.jsp" method="POST">

                            <?php
                            $passedAmt = '87ABD23777';
                            $validationKeyString = $passedAmt .$data[0]->orderNum .$data[0]->due_amt;
                            $hashedValidationKey = userInfo::getHash($validationKeyString);
                            ?>

                            <button class="btn btn-primary btn-lg btn-block" name="btnPayment" type="submit" <?php if ($data[0]->due_amt == '0'){ ?> disabled <?php } ?> >Continue to Pay </button>
                            <input type="hidden" name="UPAY_SITE_ID" value="8">
                            <input type="hidden" name="AMT" value="<?php print $data[0]->due_amt ?>">
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

                    <p class="card-title"><h2><span class="text-dark">USER INFORMATION</span></h2></p>

                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <h4><span class="badge badge-secondary">Full Name :</span></h4>
                            <h5><span class="badge badge-light"><?php print $data[0]->user_name?></span></h5>
                        </div>

                        <div class="col-md-5 mb-2">
                            <h4><span class="badge badge-secondary">Primary Email :</span></h4>
                            <h5><span class="badge badge-light"><?php print $data[0]->user_email?></span></h5>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <h4><span class="badge badge-secondary">Order Number :</span></h4>
                            <h5><span class="badge badge-light"><?php print $data[0]->orderNum?></span></h5>
                        </div>

                        <div class="col-md-5 mb-2">
                            <h4><span class="badge badge-secondary">Payment Type Selected :</span></h4>
                            <h5><span class="badge badge-light"><?php print $data[0]->payment_type?></span></h5>
                        </div>
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