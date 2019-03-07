<?php

final class appConfigModel extends \database\model
{
    public $appId;
    public $appName;
    public $appCode;

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