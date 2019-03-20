<?php

final class userInfoModel extends \database\model
{
    public $id;
    public $orderNum;
    public $user_name;
    public $user_email;
    public $gender;
    public $parent_name;
    public $parent_nmail;
    public $parent_number;
    public $school_name;
    public $grad_year;
    public $street_address;
    public $city;
    public $state;
    public $zipCode;

    protected static $modelName = 'userInfoModel';

    public static function getTablename()
    {
        $tableName = 'userInfo';
        return $tableName;
    }
    
    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
