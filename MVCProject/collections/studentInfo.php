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

    static public function getStudentInfo()
    {
        $sql = "SELECT id AS 'ID', studentName AS 'Student Name', studentEmail AS 'Email Address',parentName AS 'Parent Name',
                schoolName AS 'School Name', streetAddress AS 'Street Address', city AS 'City', state AS 'State' , zipCode AS 'ZipCode' FROM studentInfo";
        return self::getResults($sql);
    }
}