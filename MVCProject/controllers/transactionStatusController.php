<?php

class transactionStatusController extends http\controller
{
    public static function updateTranStatus() {

        $orderNo = $_REQUEST['EXT_TRANS_ID'];
        studentOrderInfo::updateStudentOrder($orderNo);

        transactionStatusController::displayTranStatus();
    }

    public static function displayTranStatus() {

        self::getTemplate('transactionStatus',Null, Null);
    }
}