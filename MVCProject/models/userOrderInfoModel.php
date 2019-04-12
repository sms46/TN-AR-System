<?php

final class userOrderInfoModel extends \database\model
{
    public $id;
    public $orderNum;
    public $user_name;
    public $user_email;
    public $payment_type;
    public $product_amt;
    public $amt_paid;
    public $due_amt;
    public $timestamp;
    public $order_confirmed;
    public $payment_status;
    public $confirmed_timestamp;

    protected static $modelName = 'userOrderInfoModel';

    public static function getTablename()
    {
        $tableName = 'userOrderInfo';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
