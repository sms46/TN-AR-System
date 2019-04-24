<?php

class userInfo extends \database\collection
{
    protected static $modelName = 'userInfoModel';

    // Static Functions

    //Random code to generate order Num
    public static function randomCode($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    //Get the current timestamp
    public static function getTimestamp()
    {
        $date= date_create(null,timezone_open("America/New_York"));
        $currentDateTimeFormat = date_format($date, 'Y-m-d H:i:s');
        return $currentDateTimeFormat;
    }

    //Get Hash value
    public static function getHash($string)
    {
        //Need to convert it into hex string to pass to touchnet
        return base64_encode( pack('H*', md5($string)));
    }
}