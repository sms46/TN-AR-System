<?php

final class userInfoModel extends \database\model
{
    public $id;
    public $orderNum;
    public $user_name;
    public $user_email;
    
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
