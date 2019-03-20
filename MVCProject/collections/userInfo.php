<?php

class userInfo extends \database\collection
{
    protected static $modelName = 'userInfo';

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


    //TO:DO
    public static function getOrderCount($OrderNum)
    {
        $sql = "SELECT count(*) AS 'OrderCount' FROM userInfo WHERE OrderNum = '$OrderNum'";

        return self::getResults($sql);
    }

    public static function getDataForExcel($statusType, $dropDown)
    {

        $sql = "SELECT DISTINCT(SI.orderNum),TempTable.studentName, TempTable.studentEmail,SI.gender,SI.parentEmail,SI.parentName,
	                   SI.parentNumber,SI.streetAddress, SI.city, SI.state,SI.zipCode,TempTable.paymentType,
                       TempTable.orderConfirmed, TempTable.paymentStatus, TempTable.confirmedTimestamp
                FROM
	                (
                       SELECT SC.studentName, SO.studentEmail, SC.course, SC.startDate,
                              SO.timestamp,SO.orderConfirmed, SO.paymentStatus,SO.confirmedTimestamp,SO.courseAmt, SO.amtPaid,
                              SO.dueAmt,SO.paymentType,SO.orderNum
                       FROM studentOrderInfo SO JOIN studentCourseInfo SC
                       ON SO.studentName = SC.studentName
                       AND SO.orderNum = SC.orderNum
                            
                       WHERE SO.orderConfirmed = 'Y'
                       AND SO.paymentStatus = 1
                        
	                ) TempTable
                    
                JOIN courses C
                ON TempTable.course = C.Description
                AND TempTable.startDate = C.StartDate
                                
                JOIN studentInfo SI
                ON TempTable.orderNum = SI.orderNum";

        return self::getResults($sql);
    }
}