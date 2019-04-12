<?php

class checkBalanceController extends http\controller
{
    public static function checkBalance()
    {
        if(isset($_POST["checkBalance"])) {

            //$studentName = $_POST['studentName'];
            //$email = $_POST['email'];
            $orderNo = $_POST['orderNo'];

            //FIX: Added a condition to handle multiple records having same email address
            $userDetailsArray = userOrderInfo::retrieveUpdatedUserOrder($orderNo);

            if($userDetailsArray != null){

                //$queryStdName = $userDetailsArray[0]->studentName;
                //$queryStdEmail = $userDetailsArray[0]->studentEmail;
                $queryStdOrdNum = $userDetailsArray[0]->orderNum;

                if($orderNo == $queryStdOrdNum){
                    self::getTemplate('userBalanceInfo',NULL,$userDetailsArray);

                } else {
                         echo '<script>alert("No matching records found. Please try again with correct Email Address and Order Number.")</script>';
                         $app_id = $_REQUEST['app_id'];
                         $productPage = products::findProducts($app_id);
                         self::getTemplate('productRegistration',NULL,$productPage);
                }

            } else{

                echo '<script>alert("No records available for the user. Please Try Again")</script>';
                $app_id = $_REQUEST['app_id'];
                $productPage = products::findProducts($app_id);
                self::getTemplate('productRegistration',NULL,$productPage);
            }
        }
    }
}