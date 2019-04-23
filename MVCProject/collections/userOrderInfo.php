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
        $sql = "SELECT TempTable.user_name, TempTable.user_email, TempTable.product_id, P.name, P.description, TempTable.price_id, 
                       TempTable.timestamp, TempTable.order_confirmed, TempTable.payment_status, TempTable.confirmed_timestamp, 
                       TempTable.product_amt, TempTable.amt_paid, TempTable.due_amt, TempTable.payment_type, TempTable.orderNum, 
                       P.app_id, P.item_remain
                            FROM
                                (
                                    SELECT UPI.user_name, UOI.user_email, UPI.product_id, UPI.price_id, UOI.timestamp,
                                           UOI.order_confirmed, UOI.payment_status, UOI.confirmed_timestamp, UOI.product_amt, 
                                           UOI.amt_paid, UOI.due_amt, UOI.payment_type, UOI.orderNum
                                    FROM userOrderInfo UOI JOIN userProductInfo UPI
                                    ON UOI.user_name = UPI.user_name
                                    AND UOI.orderNum = UPI.order_num
                            
                                    WHERE UOI.order_confirmed = 'Y'
                                    AND UOI.payment_status = 1
                                    AND UOI.orderNum = '$OrderNum'
                                        
                                ) TempTable
                                    
                            JOIN products P
                            ON  TempTable.product_id = P.id
                                
                            JOIN userInfo UI
                            ON  TempTable.orderNum = UI.orderNum";

        return self::getResults($sql);
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

    
    // Static Functions for Admin Page

    public static function getRegisteredUserInfo($appId)
    {
        $sql = "SELECT UO.orderNum AS 'OrderNo', UO.user_name AS 'User', UO.user_email AS 'PrimaryEmail',
	                   UO.confirmed_timestamp AS 'DateRegistered' 
                FROM userOrderInfo UO JOIN (
										      SELECT DISTINCT UPI.order_num
										      FROM userProductInfo UPI JOIN products P
										      ON UPI.product_id = P.id
										      WHERE P.app_id = '$appId'
										      AND P.active = '1'
								           ) Temp
									  
                ON UO.orderNum = Temp.order_num
        
                WHERE UO.order_confirmed = 'Y'
                AND UO.payment_status = '1'";

        return self::getResults($sql);
    }

    public static function getPartialPayment($appId)
    {
        $sql = "SELECT UO.orderNum AS 'Order No', UO.user_name AS 'User', UO.user_email AS 'Primary Email',
	                   UO.product_amt AS 'Total Amt', UO.due_amt AS 'Due Amt', UO.confirmed_timestamp AS 'Date Registered' 
                FROM userOrderInfo UO JOIN (
                                              SELECT DISTINCT UPI.order_num
                                              FROM userProductInfo UPI JOIN products P
                                              ON UPI.product_id = P.id
                                              WHERE P.app_id = '$appId'
                                              AND P.active = '1'
                                           ) Temp
                                              
                ON UO.orderNum = Temp.order_num
        
                WHERE UO.order_confirmed = 'Y'
                AND UO.payment_status = '1'
                AND UO.payment_type = 'Deposit'";

        return self::getResults($sql);
    }

    public static function getProductsAdmin($appId)
    {
        $sql = "SELECT id AS 'Product Id', name AS 'Name', categories AS 'Category', description, 
	                   item_remain AS 'Items Remaining', active AS 'Active Status'
                FROM products
                WHERE app_id = '$appId'
                AND active = '1'";

        return self::getResults($sql);
    }

    public static function getProductsInfoAdmin($appId)
    {
        $sql = "SELECT UPI.order_num, UPI.user_name , P.name, P.categories, P.description
                FROM userProductInfo UPI JOIN products P
                ON UPI.product_id = P.id
                WHERE P.app_id = '$appId'";

        return self::getResults($sql);
    }
    
}