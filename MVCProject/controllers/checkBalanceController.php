<?php

class checkBalanceController extends http\controller
{
    public static function checkBalance()
    {
        if(isset($_POST["checkBalance"])) {

            $studentName = $_POST['studentName'];
            $email = $_POST['email'];
            $orderNo = $_POST['orderNo'];

            studentOrderInfo::retrieveUpdatedStudentOrder($orderNo);

            //self::getTemplate('userBalanceInfo',null,null);
        }
    }

}