<?php

class studentInfo extends \database\collection
{
    protected static $modelName = 'studentInfo';

    // Static Functions
    public static function randomCode($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public static function getTimestamp()
    {
        $date= date_create(null,timezone_open("America/New_York"));
        $currentDateTimeFormat = date_format($date, 'Y-m-d H:i:s');
        return $currentDateTimeFormat;
    }

    public static function getHash($string)
    {
        //Need to convert it into hex string to pass to touchnet
        return base64_encode( pack('H*', md5($string)));
    }

    public static function getOrderCount($OrderNum)
    {
        $sql = "SELECT count(*) AS 'OrderCount' FROM studentInfo WHERE OrderNum = '$OrderNum'";

        return self::getResults($sql);
    }
}