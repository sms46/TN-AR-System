<?php

class userLogs extends \database\collection
{
    protected static $modelName = 'userLogsModel';

    //static functions
    public static function retrieveUserInfoForLogs($orderNum)
    {
        $sql = "SELECT user_name, user_email, due_amt 
                FROM userOrderInfo 
                WHERE orderNum = '$orderNum'";

        return self::getResults($sql);
    }

    public static function getLogData($orderNum)
    {
        $sql = "SELECT * FROM userLogs WHERE EXT_TRANS_ID = '$orderNum'";

        return self::getResults($sql);
    }
}