<?php

class checkBalanceController extends http\controller
{
    public static function checkBalance()
    {
        if(isset($_POST["checkBalance"])) {

            $studentName = $_POST['studentName'];
            $email = $_POST['email'];
            $orderNo = $_POST['orderNo'];

            $studentDetails = studentOrderInfo::getStudentDetails($orderNo);

            if($studentDetails != null){

                $queryStdName = $studentDetails[0]->studentName;
                $queryStdEmail = $studentDetails[0]->studentEmail;
                $queryStdOrdNum = $studentDetails[0]->orderNum;

                if(($studentName == $queryStdName && $email == $queryStdEmail)&&($orderNo == $queryStdOrdNum)){

                    $studentDetailsArray = studentOrderInfo::retrieveUpdatedStudentOrder($orderNo);
                    self::getTemplate('userBalanceInfo',$studentDetailsArray,$studentDetailsArray);
                } else {
                        $data = 'No matching records found. Please try again.';
                        self::getTemplate('error', NULL, $data);
                }

            } else{
                $data = 'No records available for the user. Please Try Again';
                self::getTemplate('error',NULL, NULL);
            }
        }
    }
}