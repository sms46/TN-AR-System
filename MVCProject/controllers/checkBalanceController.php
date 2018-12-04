<?php

class checkBalanceController extends http\controller
{
    public static function checkBalance()
    {
        if(isset($_POST["checkBalance"])) {

            //$studentName = $_POST['studentName'];
            $email = $_POST['email'];
            $orderNo = $_POST['orderNo'];

            $studentDetails = studentOrderInfo::getStudentDetails($orderNo);

            if($studentDetails != null){

                //$queryStdName = $studentDetails[0]->studentName;
                $queryStdEmail = $studentDetails[0]->studentEmail;
                $queryStdOrdNum = $studentDetails[0]->orderNum;

                if(($email == $queryStdEmail)&&($orderNo == $queryStdOrdNum)){

                    $studentDetailsArray = studentOrderInfo::retrieveUpdatedStudentOrder($orderNo);
                    self::getTemplate('userBalanceInfo',$studentDetailsArray,$studentDetailsArray);

                } else {
                         echo '<script>alert("No matching records found. Please try again with correct Email Address and Order Number.")</script>';
                        $courseRegister = courses::findCourses();
                        self::getTemplate('courseRegistration',NULL,$courseRegister);
                }

            } else{

                echo '<script>alert("No records available for the user. Please Try Again")</script>';
                $courseRegister = courses::findCourses();
                self::getTemplate('courseRegistration',NULL,$courseRegister);
            }
        }
    }
}