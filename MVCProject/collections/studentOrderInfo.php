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
                  TempTable.orderConfirmed, TempTable.paymentStatus, TempTable.confirmedTimestamp, TempTable.courseAmt, TempTable.amtPaid,TempTable.orderNum,
                  TempTable.dueAmt, TempTable.paymentType, C.appName, C.SeatAvailable, SI.streetAddress, SI.city, SI.state, SI.zipCode
                FROM
                    (
                        SELECT SC.studentName, SO.studentEmail, SC.course, SC.startDate,
                        SO.timestamp,SO.orderConfirmed, SO.paymentStatus,SO.confirmedTimestamp,SO.courseAmt, SO.amtPaid, SO.dueAmt,
                        SO.paymentType,SO.orderNum
                        FROM studentOrderInfo SO JOIN studentCourseInfo SC
                        ON SO.studentName = SC.studentName
						AND SO.orderNum = SC.orderNum
            
                        WHERE SO.orderConfirmed = \'Y\'
                        AND SO.paymentStatus = 1
                        AND SO.orderNum = ?
                        
                    ) TempTable
                    
                JOIN courses C
                ON  TempTable.course = C.Description
                AND TempTable.startDate = C.StartDate
				
			    JOIN studentInfo SI
			    ON  TempTable.orderNum = SI.orderNum';

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

    public static function getStudentDetails($OrderNum)
    {
        $sql = "SELECT studentEmail, orderNum FROM studentOrderInfo WHERE orderNum  = '$OrderNum' ";

        return self::getResults($sql);
    }

    public static function updateTransaction($OrderNum, $AmtPaid)
    {
        //Get values from the config File
        $configs = include('config.php');

        //Get Application Fee from the config file
        $applicationAmt = $configs->appFee;

        //Subtracting Aff Fee from the Amount Paid:
        $totalAmtPaid = $AmtPaid - $applicationAmt;

        $orderInfo =studentOrderInfo::getOrderId($OrderNum);

        //Get the Payment type selected by the user
        $payType = $orderInfo->paymentType;

        if($payType == 'Deposit'){

            //Get Order Confirmation Status
            $status = $orderInfo->orderConfirmed;

            if($status == 'N'){

                //Update the Balance Due for deposit
                $updatedBalDue = ($orderInfo->dueAmt) - $totalAmtPaid;
            }else{

                //Update the Balance Due for deposit
                $updatedBalDue = ($orderInfo->dueAmt) - $AmtPaid;
            }

            //Update the Amount Due for deposit
            $updatedAmtPaid = ($orderInfo->amtPaid) + $AmtPaid;

        }else{

            //Update the Amount Paid and Balance Due for deposit
            $updatedBalDue = 0;
            $updatedAmtPaid = $AmtPaid;
        }

        //Update the Student Order Info Table
        $order = new studentOrderInfoModel();
        $order->id = $orderInfo->id;
        $order->amtPaid = $updatedAmtPaid;
        $order->dueAmt = $updatedBalDue;
        $order->confirmedTimestamp = studentInfo::getTimestamp();
        $order->save();
    }

    // Static Functions for Admin Page

    public static function getRegisteredStudentInfo()
    {
        $sql = "SELECT SO.orderNum AS 'Order No',SO.studentName AS 'Student Name', SO.studentEmail AS 'Email Address',
                       SI.gender AS 'Gender', SI.gradYear AS 'Grad Year', SO.paymentType AS 'Payment Type',SO.confirmedTimestamp AS 'Registered Date'
                FROM studentOrderInfo SO JOIN studentInfo SI
                
                ON SO.studentName = SI.studentName
                AND SO.orderNum = SI.orderNum
                
                WHERE SO.paymentStatus = 1";

        return self::getResults($sql);
    }

    public static function getPartialPayment()
    {
        $sql = "SELECT SO.orderNum AS 'Order No',SO.studentName AS 'Student Name', SO.studentEmail AS 'Email Address',
                       SI.gradYear AS 'Grad Year', SO.courseAmt AS 'Course Amount($)',SO.AmtPaid AS 'Amount Paid($)', 
                       SO.dueAmt AS 'Balance Due($)',SO.confirmedTimestamp AS 'Registered Date'
                FROM studentOrderInfo SO JOIN studentInfo SI
                
                ON SO.studentName = SI.studentName
                AND SO.orderNum = SI.orderNum
                
                WHERE SO.paymentStatus = 1
                AND SO.paymentType = 'Deposit'";

        return self::getResults($sql);
    }

    public static function getCoursesInfoAdmin()
    {
        $sql = "SELECT Session, Description,StartDate, EndDate, ResidentialPrice AS 'Residential Price',
                CommuterPrice AS 'Commuter Price', Department, SeatAvailable AS 'Available Seats' 
                FROM courses";

        return self::getResults($sql);
    }

    public static function getDataForExcel($startDate, $endDate)
    {
        // TODO: $sql = "SELECT * FROM studentOrderInfo WHERE confirmedTimestamp BETWEEN '$startDate' AND ' $endDate'";
        $sql = "SELECT * FROM studentOrderInfo";

        return self::getResults($sql);
    }

}