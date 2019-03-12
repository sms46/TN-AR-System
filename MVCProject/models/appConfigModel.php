<?php

final class appConfigModel extends \database\model
{
    public $app_id;
    public $app_name;
    public $app_code;

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