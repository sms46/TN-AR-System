<?php

final class paymentTypeModel extends \database\model
{
    public $id;
    public $pay_type;
    public $app_id;

    protected static $modelName = 'paymentTypeModel';

    public static function getTablename()
    {
        $tableName = 'paymentType';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>