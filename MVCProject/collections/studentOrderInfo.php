<?php

class studentOrderInfo extends \database\collection
{
    protected static $modelName = 'studentOrderInfo';

    // Static Functions
    public static function updateStudentOrder($num)
    {
        //Update the student order table after successful payment
        $order = new studentOrderInfoModel();
        $orderId = studentOrderInfo::getOrderId($num);
        $order->id = $orderId->id;
        $order->orderConfirmed = 'Y';
        $order->paymentStatus = '1';
        $order->confirmedTimestamp = studentInfo::getTimestamp();
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
}