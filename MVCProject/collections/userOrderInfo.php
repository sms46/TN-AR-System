<?php

class userOrderInfo extends \database\collection
{
    protected static $modelName = 'userOrderInfoModel';

    // Static Functions

    //Update Transaction
    public static function updateTransaction($OrderNum, $AmtPaid)
    {
        //Get values from the config File
        $configs = include('config.php');

        //Get Application Fee from the config file
        $applicationAmt = $configs->appFee;

        //Subtracting Aff Fee from the Amount Paid:
        $totalAmtPaid = $AmtPaid - $applicationAmt;

        $orderInfo = userOrderInfo::getOrderId($OrderNum);

        //Get the Payment type selected by the user
        $payType = $orderInfo->payment_type;

        if($payType == 'Deposit'){

            //Get Order Confirmation Status
            $status = $orderInfo->order_confirmed;

            if($status == 'N'){

                //Update the Balance Due for deposit
                $updatedBalDue = ($orderInfo->due_amt) - $totalAmtPaid;
            }else{

                //Update the Balance Due for deposit
                $updatedBalDue = ($orderInfo->due_amt) - $AmtPaid;
            }

            //Update the Amount Due for deposit
            $updatedAmtPaid = ($orderInfo->amt_paid) + $AmtPaid;

        }else{

            //Update the Amount Paid and Balance Due for deposit
            $updatedBalDue = 0;
            $updatedAmtPaid = $AmtPaid;
        }

        //Update the Student Order Info Table
        $order = new userOrderInfoModel();
        $order->id = $orderInfo->id;
        $order->amt_paid = $updatedAmtPaid;
        $order->due_amt = $updatedBalDue;
        $order->confirmed_timestamp = userInfo::getTimestamp();
        $order->save();
    }

    public static function getOrderId($OrderNum)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE orderNum = ?';

        //grab the order id to update and return as an object
        $recordsSet = self::getResults($sql, $OrderNum);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }

    public static function updateUserOrder($num)
    {
        //Update the student order table after successful payment
        $order = new userOrderInfoModel();
        $orderId = userOrderInfo::getOrderId($num);
        $order->id = $orderId->id;
        $order->order_confirmed = 'Y';
        $order->payment_status = '1';
        $order->confirmed_timestamp = userInfo::getTimestamp();
        $order->save();
    }

    public static function retrieveUpdatedUserOrder($OrderNum)
    {
        $sql = 'SELECT TempTable.user_name, TempTable.user_email, TempTable.product_id, TempTable.price_id, TempTable.timestamp,
	                   TempTable.order_confirmed, TempTable.payment_status, TempTable.confirmed_timestamp, TempTable.course_amt, 
                       TempTable.amt_paid, TempTable.due_amt, TempTable.payment_type, TempTable.orderNum, P.app_id, 
                       P.item_remain, UI.street_address, UI.city, UI.state, UI.zipCode
                            FROM
                                (
                                    SELECT UPI.user_name, UOI.user_email, UPI.product_id, UPI.price_id, UOI.timestamp,
                                           UOI.order_confirmed, UOI.payment_status, UOI.confirmed_timestamp, UOI.course_amt, 
                                           UOI.amt_paid, UOI.due_amt, UOI.payment_type, UOI.orderNum
                                    FROM userOrderInfo UOI JOIN userProductInfo UPI
                                    ON UOI.user_name = UPI.user_name
                                    AND UOI.orderNum = UPI.order_num
                            
                                    WHERE UOI.order_confirmed = \'Y\'
                                    AND UOI.payment_status = 1
                                    AND UOI.orderNum = ?
                                        
                                ) TempTable
                                    
                            JOIN products P
                            ON  TempTable.product_id = P.id
                                
                            JOIN userInfo UI
                            ON  TempTable.orderNum = UI.orderNum';

        return self::getResults($sql, $OrderNum);
    }

    public static function updateNoOfSeats($productId,$seatsAvailable)
    {
        if($seatsAvailable > 0){

            //Update the courses table with seats availability after successful payment
            $seats = new productsModel();
            $seats->id = $productId;
            $seats->item_remain = $seatsAvailable - 1;
            $seats->save();
        }
    }

    public static function getStudentDetails($OrderNum)
    {
        $sql = "SELECT studentEmail, orderNum FROM studentOrderInfo WHERE orderNum  = '$OrderNum' ";

        return self::getResults($sql);
    }


    // Static Functions for Admin Page

    public static function getRegisteredStudentInfo()
    {
        $sql = "SELECT SO.orderNum AS 'Order No',SO.studentName AS 'Student Name', SO.studentEmail AS 'Email Address',
                       SI.gender AS 'Gender', SI.gradYear AS 'Grad Year', SO.paymentType AS 'Payment Type',SO.confirmedTimestamp AS 'Registered Date'
                FROM userOrderInfo SO JOIN userInfo SI
                
                ON SO.studentName = SI.studentName
                AND SO.orderNum = SI.orderNum
                
                WHERE SO.paymentStatus = 1";

        return self::getResults($sql);
    }

    public static function getPartialPayment()
    {
        $sql = "SELECT SO.orderNum AS 'Order No',SO.studentName AS 'Student Name', SO.studentEmail AS 'Email Address',
                       SI.gradYear AS 'Grad Year', SO.courseAmt AS 'Course Amount($)',SO.AmtPaid AS 'Amount Paid($)', 
                       SO.dueAmt AS 'Balance Due($)',SO.confirmedTimestamp AS 'Registered Date'
                FROM studentOrderInfo SO JOIN studentInfo SI
                
                ON SO.studentName = SI.studentName
                AND SO.orderNum = SI.orderNum
                
                WHERE SO.paymentStatus = 1
                AND SO.paymentType = 'Deposit'";

        return self::getResults($sql);
    }

    public static function getCoursesAdmin()
    {
        $sql = "SELECT Session, Description,StartDate, EndDate, ResidentialPrice AS 'Residential Price',
                CommuterPrice AS 'Commuter Price', Department, SeatAvailable AS 'Available Seats', Active 
                FROM courses";

        return self::getResults($sql);
    }

    public static function getCoursesInfoAdmin()
    {
        $sql = "SELECT orderNum AS 'Order No', studentName AS 'Student Name',course AS 'Registered Courses', 
                department AS 'Department',startDate AS 'Start Date', year , timestamp AS 'Registered Date'
                FROM studentCourseInfo ORDER BY timestamp";

        return self::getResults($sql);
    }
    
}