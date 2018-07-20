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

        // echo '<pre>'; var_dump($studentOrder);

        // loop through all the courses taken by the student
        for ($i=0; $i< count($studentOrder); $i++)
        {
            $confirmedCourses = $studentOrder[$i]->course;
            $confirmedDates = $studentOrder[$i]->startDate;
            $seatsCount = $studentOrder[$i]->SeatAvailable;

            //Update the no of seats available for all courses taken by the student to total count
            studentOrderInfo::updateNoOfSeats($confirmedCourses,$confirmedDates,$seatsCount);
        }

        //Redirect to the transaction status page
        transactionStatusController::displayTranStatus();
    }

    public static function displayTranStatus() {

        self::getTemplate('transactionStatus',Null, Null);
    }
}
