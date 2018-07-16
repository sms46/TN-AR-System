<?php

class transactionStatusController extends http\controller
{
    public static function displayTranStatus() {

        //$orderNo = $_REQUEST['EXT_TRANS_ID'];
        self::getTemplate('transactionStatus',Null, Null);
    }
}