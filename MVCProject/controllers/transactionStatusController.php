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

        //echo '<pre>'; var_dump($studentOrder);
        //echo '<pre>'; var_dump($_REQUEST);
        //echo $_GET['tpg_trans_id '];

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

    public static function postBackInfo() {

        //Insert into the student - order table
        $post = new postBackInfoModel();
        $post->EXT_TRANS_ID = $_POST['EXT_TRANS_ID'];
        $post->UPAY_SITE_ID = $_POST['UPAY_SITE_ID'];
        $post->sys_tracking_id = $_POST['sys_tracking_id'];
        $post->tpg_trans_id = $_POST['tpg_trans_id'];
        $post->name_on_acct = $_POST['name_on_acct'];
        $post->acct_email_address = $_POST['acct_email_address'];
        $post->pmt_status = $_POST['pmt_status'];
        $post->pmt_amt = $_POST['pmt_amt'];
        $post->acct_addr = $_POST['acct_addr'];
        $post->acct_addr2 = $_POST['acct_addr2'];
        $post->acct_city = $_POST['acct_city'];
        $post->acct_state = $_POST['acct_state'];
        $post->acct_zip = $_POST['acct_zip'];
        $post->pmt_date = $_POST['pmt_date'];
        $post->save();

    }
}
