<?php

class userLogs extends \database\collection
{
    protected static $modelName = 'userLogs';

    //static functions
    public static function getLogData($orderNum)
    {
        $sql = "SELECT * FROM userLogs WHERE EXT_TRANS_ID = '$orderNum'";

        return self::getResults($sql);
    }

    public static function retrieveStudentInfoForLogs($orderNum)
    {
        $sql = "SELECT studentName, studentEmail, dueAmt FROM studentOrderInfo WHERE orderNum = '$orderNum'";

        return self::getResults($sql);
    }
}