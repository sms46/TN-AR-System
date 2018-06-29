<?php

final class studentOrderInfoModel extends \database\model
{
    public $orderId;
    public $orderNum;
    public $studentName;
    public $studentEmail;
    public $parentName;
    public $courseAmt;
    public $paymentType;
    public $dueAmt;
    public $schoolName;
    public $streetAddress;
    public $zipCode;
    public $timestamp;
    public $orderStatus;
    public $paymentStatus;

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
