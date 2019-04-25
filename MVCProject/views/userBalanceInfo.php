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
        <?php 

        $app_id = $_REQUEST['app_id'];
        $appOut = appConfig::getAppName($app_id);
        $titleName = $appOut[0]->app_name;


        ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <!-- Suppressed the sideNav-->
                <!--<button type="button" id="sidebarCollapse" class="btn btn-default">
                    <i class="fas fa-align-justify"></i>
                </button>-->

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <a style="font-size: xx-large" href="index.php?page=homepage&action=redirectToProduct&id=<?php print $app_id?>"><h1>&nbsp;&nbsp;&nbsp;<?php print $titleName;?></h1></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class="btn btn-outline-primary" href="#" data-toggle="modal" data-target="#modalCheckBalance">Check Balance Due</a>
                            <br>
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

                                        <!--Student's Full Name: <input type="text" class="form-control" name="studentName" placeholder="Enter Student's Full Name" value="" required><br/>-->
                                        <!--Email Address:  <input type="email" class="form-control" name="email" placeholder="you@example.com" required/><br/>-->
                                        Order Number:<input type="text" class="form-control" name="orderNo" placeholder="Enter your Order Number" required/><br/>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Check" name="checkBalance" class="btn btn-success"/>
                                        <input type="hidden" name="app_id" value= "<?php print $_REQUEST["app_id"]?>" >
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <h3 class="text-danger".text-danger align="center"><strong>USER PROFILE</strong></h3><hr/><br/>

        <div class="container" style="width:1400px;">
            <div class="row">
                <div class="col-md-5 order-md-3 mb-3 shadow-lg p-3 mb-5 bg-white rounded ">

                    <h4 align="center" class="text-primary">Balance Information</h4><hr/>
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
                                <h6 class="my-0">Amount Paid</h6>
                            </div>
                            <span class="text-success">
                                <strong>
                                    <?php print '$'. $data[0]->amt_paid?>
                                </strong>
                            </span>
                        </li>

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

                            $appId = $_REQUEST['app_id'];
                            $appOut = appConfig::getAppName($appId);

                            $app_key = $appOut[0]->app_key;
                            $site_id = $appOut[0]->site_id;

                            //$passedAmt = '87ABD23777';
                            $validationKeyString = $app_key .$data[0]->orderNum .$data[0]->due_amt;
                            $hashedValidationKey = userInfo::getHash($validationKeyString);
                            ?>

                            <button class="btn btn-primary btn-lg btn-block" name="btnPayment" type="submit" <?php if ($data[0]->due_amt <= '0'){ ?> disabled <?php } ?> >Continue to Pay </button>
                            <input type="hidden" name="UPAY_SITE_ID" value="<?php print $site_id ?>">
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

                    <p class="card-title"><h3><span class="text-primary">USER INFORMATION</span></h3></p>

                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <h5><span class="text-dark">Full Name :</span></h5>
                            <h6><span class="text-danger"><?php print $data[0]->user_name?></span></h6>
                        </div>

                        <div class="col-md-5 mb-2">
                            <h5><span class="text-dark">Primary Email :</span></h5>
                            <h6><span class="text-danger"><?php print $data[0]->user_email?></span></h6>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <h5><span class="text-dark">Order Number :</span></h5>
                            <h6><span class="text-danger"><?php print $data[0]->orderNum?></span></h6>
                        </div>

                        <div class="col-md-5 mb-2">
                            <h5><span class="text-dark">Payment Type Selected :</span></h5>
                            <h6><span class="text-danger"><?php print $data[0]->payment_type?></span></h6>
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