<?php

final class adminAccountsModel extends \database\model
{
    public $id;
    public $user_name;
    public $password;
    public $app_id;
    public $is_admin;
    public $has_access;
    public $grant_access_by;

    protected static $modelName = 'adminAccountsModel';

    public static function getTablename()
    {
        $tableName = 'adminAccounts';
        return $tableName;
    }

    //Add a method to compare the passwords with BCRYRT
    public function setPassword($password) {
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        return $hashPassword;
    }

    public function checkPassword($LoginPassword) {
        return password_verify($LoginPassword, $this->password);
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>