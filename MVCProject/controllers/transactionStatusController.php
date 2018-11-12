<?php

class transactionStatusController extends http\controller
{
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

        //Retrieve Order No and Amt Paid from touchnet
        $orderNo = $_REQUEST['EXT_TRANS_ID'];
        $amtPaid = $_POST['pmt_amt'];

        //get log data for particular order num
        $userLogsBef = userLogs::getLogData($orderNo);
        $countData = count($userLogsBef);

        //UPDATE IF DUE AMT IS GREATER THAN 0
        if($countData > 1)
        {
            $orderInfo =studentOrderInfo::getOrderId($orderNo);
            $updatedAmtPaid = ($orderInfo->amtPaid) + $amtPaid;
            $updatedBalDue = ($orderInfo->courseAmt) - $updatedAmtPaid;
            $order = new studentOrderInfoModel();
            $order->id = $orderInfo->id;
            $order->amtPaid = $updatedAmtPaid;
            $order->dueAmt = $updatedBalDue;
            $order->confirmedTimestamp = studentInfo::getTimestamp();
            $order->save();
        }

        //Update the order status if successful payment done via touchnet
        studentOrderInfo::updateStudentOrder($orderNo);

        //Retrieve the student info after successful payment
        $studentOrder = studentOrderInfo::retrieveUpdatedStudentOrder($orderNo);

        //echo '<pre>'; var_dump($studentOrder);
        //echo '<pre>'; var_dump($_REQUEST);
        //echo $_GET['tpg_trans_id '];

        //Retrieve Student Info for logs
        $studentInfoLogs = userLogs::retrieveStudentInfoForLogs($orderNo);

        //LOG USER INFO
        $log = new userLogsModel();
        $log->EXT_TRANS_ID = $_POST['EXT_TRANS_ID'];
        $log->studentName = $studentInfoLogs[0]->studentName;
        $log->studentEmail = $studentInfoLogs[0]->studentEmail;
        $log->tpg_trans_id = $_POST['tpg_trans_id'];
        $log->amtPaid = $_POST['pmt_amt'];
        $log->balanceAmt = ($studentInfoLogs[0]->dueAmt);
        $log->paymentStatus = 'Transaction complete using Touchnet';
        $log->description = 'Payment Success';
        $log->currentTimestamp = studentInfo::getTimestamp();
        $log->save();

        //get log data for particular order num
        $userLogsAf = userLogs::getLogData($orderNo);
        $countDataAf = count($userLogsAf);


        if($countDataAf < 3 && $countDataAf > 0){
            // loop through all the courses taken by the student
            for ($i=0; $i< count($studentOrder); $i++)
            {
                $confirmedCourses = $studentOrder[$i]->course;
                $confirmedDates = $studentOrder[$i]->startDate;
                $seatsCount = $studentOrder[$i]->SeatAvailable;

                //Update the no of seats available for all courses taken by the student to total count
                studentOrderInfo::updateNoOfSeats($confirmedCourses,$confirmedDates,$seatsCount);
            }
        }
    }
}
