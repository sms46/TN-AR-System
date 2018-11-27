<!DOCTYPE html>
<html>

<?php include 'headers.php';?>

<body class="bg-light">


<?php $orderNo = $_REQUEST['EXT_TRANS_ID'];

$studentInfo = studentOrderInfo::getOrderId($orderNo);
$courseAmt = $studentInfo->courseAmt;
$amtPaid = $studentInfo->amtPaid;

$dueAmt = $studentInfo->dueAmt;
//echo '<pre>'; var_dump($_GET);

?>


<div class="container" style="width:1280px;">
    <div class="card shadow-lg p-3 mb-1 bg-white rounded">
        <figure class="card-body">
            <p style="text-align:center; color: dodgerblue" class="card-title"><strong>Your Payment has been received</strong></p>
            <p style="text-align:center; color: dodgerblue" class="card-text">
                <strong> Your Order No is:</strong>
            </p>
            <p style="text-align:center;color:#04B745;" class="card-text">
                <strong><?php print $orderNo;?></strong>
            </p>

            <p style="text-align:center;color:#04B745;" class="card-text">
                <strong>The Remaining Balance is:</strong>
                $<?php print $dueAmt;?>
            </p>

            <br>
            <p style="text-align:center;color:#04B745;" class="card-text">
                <a class="btn btn-outline-success" href="index.php" role="button">Go to Homepage</a>
            </p>
         </figure>
    </div>
</div>

</body>
</html>