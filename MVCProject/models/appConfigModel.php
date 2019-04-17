<?php

final class appConfigModel extends \database\model
{
    public $id;
    public $app_name;
    public $app_code;
    public $app_key;
    public $site_id;
    public $is_deposit;
    public $deposit_amt;
    public $is_discount;
    public $disc_percent;
    public $app_fee;

    protected static $modelName = 'appConfigModel';

    public static function getTablename()
    {
        $tableName = 'appConfig';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>