<?php

final class adminAccountsModel extends \database\model
{
    public $id;
    public $userName;
    public $password;
    public $appName;
    public $hasAccess;
    public $grantAccessBy;

    protected static $modelName = 'adminAccountsModel';

    public static function getTablename()
    {
        $tableName = 'adminAccounts';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>