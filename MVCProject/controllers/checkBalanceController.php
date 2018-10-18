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
                    echo '<script>alert("No matching records found. Please try again.")</script>';
                    self::getTemplate('error', $data, $data);
                }

                //header("Location: index.php");

            } else{
                //$data = 'No records available for the user. Please Try Again';
                echo '<script>alert("No records available for the user. Please Try Again")</script>';
                //self::getTemplate('homepage', NULL, NULL);
            }
        }
    }
}