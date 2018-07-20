<?php

class transactionStatusController extends http\controller
{
    public static function updateTranStatus() {

        //Retrieve Order No from touchnet
        $orderNo = $_REQUEST['EXT_TRANS_ID'];

        //Update the order status if successful payment done via touchnet
        studentOrderInfo::updateStudentOrder($orderNo);

        //Retrieve the student info after successful payment
        $studentOrder = studentOrderInfo::retrieveUpdatedStudentOrder($orderNo);
        print_r($studentOrder);

        //$courses =  $studentOrder[2];
        //sprintf($courses);
        //foreach($studentOrder as $key=>$value){
           // echo $value["course"];
            //echo $studentOrder[$key]["startDate"];
        //}

        //Redirect to the transaction status page
        transactionStatusController::displayTranStatus();
    }

    public static function displayTranStatus() {

        self::getTemplate('transactionStatus',Null, Null);
    }
}