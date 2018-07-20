<?php

class studentOrderInfo extends \database\collection
{
    protected static $modelName = 'studentOrderInfo';

    // Static Functions
    public static function updateStudentOrder($num)
    {
        //Update the student order table after successful payment
        $order = new studentOrderInfoModel();
        $orderId = studentOrderInfo::getOrderId($num);
        $order->id = $orderId->id;
        $order->orderConfirmed = 'Y';
        $order->paymentStatus = '1';
        $order->confirmedTimestamp = studentInfo::getTimestamp();
        $order->save();
    }

    public static function getOrderId($OrderNum)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE orderNum = ?';

        //grab the order id to update and return as an object
        $recordsSet = self::getResults($sql, $OrderNum);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }

    public static function retrieveUpdatedStudentOrder($OrderNum)
    {
        $sql = 'SELECT TempTable.studentName , TempTable.studentEmail , TempTable.course, TempTable.startDate,TempTable.timestamp,
                  TempTable.orderConfirmed, TempTable.paymentStatus, TempTable.confirmedTimestamp, C.appName, C.SeatAvailable
                FROM
                    (
                        SELECT SC.studentName, SC.studentEmail, SC.course, SC.startDate,
                        SO.timestamp,SO.orderConfirmed, SO.paymentStatus,SO.confirmedTimestamp
                        FROM studentOrderInfo SO JOIN studentCourseInfo SC
                        ON SO.studentName = SC.studentName
                        AND SO.studentEmail = SC.studentEmail
            
                        WHERE SO.orderConfirmed = \'Y\'
                        AND SO.paymentStatus = 1
                        AND SO.orderNum = ?
                        
                    ) TempTable
                    
                JOIN courses C
                ON  TempTable.course = C.Description
                AND TempTable.startDate = C.StartDate';

        return self::getResults($sql, $OrderNum);
    }

    public static function updateNoOfSeats($courseName, $startDate, $seatsAvailable)
    {
        if($seatsAvailable > 0){

            //Update the courses table with seats availability after successful payment
            $seats = new courseModel();

            //get the course id from the courses table
            $courseId = studentOrderInfo::getCourseId($courseName,$startDate);
            $seats->id = $courseId[0]->id;
            $seats->SeatAvailable = $seatsAvailable - 1;
            $seats->save();
        }
    }

    public static function getCourseId($courseName,$startDate)
    {
        $sql = "SELECT * FROM courses WHERE Description = '$courseName' AND StartDate = '$startDate'";

        return self::getResults($sql);
    }

}