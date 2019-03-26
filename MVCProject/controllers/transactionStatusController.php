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

        //Update the Amt Paid and balance info of the transaction
        userOrderInfo::updateTransaction($orderNo, $amtPaid);

        //Update the order status if successful payment done via touchnet
        userOrderInfo::updateUserOrder($orderNo);
        
        //Retrieve the user info after successful payment
        $userOrder = userOrderInfo::retrieveUpdatedUserOrder($orderNo);

        //Retrieve Student Info for logs
        $userInfoLogs = userLogs::retrieveUserInfoForLogs($orderNo);

        //LOG USER INFO
        $log = new userLogsModel();
        $log->EXT_TRANS_ID = $_POST['EXT_TRANS_ID'];
        $log->user_name = $userInfoLogs[0]->user_name;
        $log->user_email = $userInfoLogs[0]->user_email;
        $log->tpg_trans_id = $_POST['tpg_trans_id'];
        $log->amt_paid = $_POST['pmt_amt'];
        $log->balance_amt = ($userInfoLogs[0]->due_amt);
        $log->payment_status = 'Transaction complete using Touchnet';
        $log->description = 'Payment Success';
        $log->current_timestamp = userInfo::getTimestamp();
        $log->save();

        //get log data for particular order num
        $userLogsAf = userLogs::getLogData($orderNo);
        $countDataAf = count($userLogsAf);


        if($countDataAf < 3 && $countDataAf > 0){
            // loop through all the courses taken by the student
            for ($i=0; $i< count($userOrder); $i++)
            {
                $confirmedCourses = $userOrder[$i]->product_id;
                $seatsCount = $userOrder[$i]->item_remain;

                //Update the no of seats available for all courses taken by the student to total count
                userOrderInfo::updateNoOfSeats($confirmedCourses,$seatsCount);
            }
        }
    }
}
