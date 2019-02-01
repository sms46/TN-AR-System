<?php

final class studentOrderInfoModel extends \database\model
{
    public $id;
    //public $orderId;
    public $orderNum;
    public $studentName;
    public $studentEmail;
    //public $parentName;
    public $paymentType;
    public $courseAmt;
    public $amtPaid;
    public $dueAmt;
    //public $schoolName;
    //public $streetAddress;
    //public $city;
    //public $state;
    //public $zipCode;
    public $timestamp;
    public $orderConfirmed;
    public $paymentStatus;
    public $confirmedTimestamp;

    protected static $modelName = 'studentOrderInfoModel';

    public static function getTablename()
    {
        $tableName = 'studentOrderInfo';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
