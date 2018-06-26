<?php include 'headers.php';?>
<?php session_start();?>

<body class="bg-light">

<legend><h2 align="center">COURSE CHECKOUT</h2></legend>
<br>
<div div class="container" style="width:1260px;">

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">&nbsp;&nbsp;&nbsp;YOUR CART</span>
                <span class="badge badge-secondary badge-pill"><?php print count($_SESSION['cart_item'])?></span>
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
                    <span>Total (USD)</span>
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
                        ?></span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>
                        <?php
                            $finalAmt = $paymentTypeAmt + $applicationAmt;
                            print '$'. $finalAmt?>
                    </strong>
                </li>

                <hr class="mb-4">
                <form action="https://test.secure.touchnet.net:8443/C20146test_upay/web/index.jsp" method="POST">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to Pay <?php echo '$'. $finalAmt?></button>
                    <input type="hidden" name="UPAY_SITE_ID" value="8">
                    <input type="hidden" name="AMT" value="<?php print $finalAmt?>">
                    <input type="hidden" name="EXT_TRANS_ID" value="123">
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

        <div class="col-md-8 order-md-1">
            <legend> <h3 class="mb-3">STUDENT INFORMATION</h3> </legend>
            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="studentName">Student's Full Name</label>
                        <input type="text" class="form-control" id="studentName" placeholder="Enter Student's Full Name" value="" required>
                        <div class="invalid-feedback">
                            Your Full Name is required.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="parentName">Parent/Guardian Name</label>
                        <input type="text" class="form-control" id="parentName" placeholder="Enter Parent/Guardian Name" value="" required>
                        <div class="invalid-feedback">
                            Your Parent/Guardian Name is required.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="highSchool">High School </label>
                        <input type="text" class="form-control" id="highSchool" placeholder="Enter High School" required>
                        <div class="invalid-feedback">
                            Your High School Name is required.
                        </div>
                    </div>
                </div>

                <br>
                <legend> <h3 class="mb-3">ADDRESS</h3> </legend>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="streetAddress">Street Address</label>
                        <input type="text" class="form-control" id="streetAddress" placeholder="Enter Street Address" value="" required>
                        <div class="invalid-feedback">
                            Street Address is required.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter City" required>
                        <div class="invalid-feedback">
                            City Name is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" placeholder="Enter State" value="" required>
                        <div class="invalid-feedback">
                            State Name is required.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="zipCode">Zip Code</label>
                        <input type="text" class="form-control" id="zipCode" placeholder="Enter Zip Code" required>
                        <div class="invalid-feedback">
                            Zip Code is required.
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

    <button type="submit" class="btn btn-success">Save Details</button>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<script src="../../assets/js/vendor/holder.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</body>
</html>
