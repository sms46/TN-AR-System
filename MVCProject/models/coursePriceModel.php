<?php

final class coursePriceModel extends \database\model
{
    public $pid;
    public $priceType;
    public $price;

    protected static $modelName = 'coursePriceModel';

    public static function getTablename()
    {
        $tableName = 'coursePrice';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>