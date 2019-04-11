<?php

final class userAddDetailsModel extends \database\model
{
    public $id;
    public $orderNum;
    public $user_data;
    public $user_value;

    protected static $modelName = 'userAddDetailsModel';

    public static function getTablename()
    {
        $tableName = 'userAddDetails';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
