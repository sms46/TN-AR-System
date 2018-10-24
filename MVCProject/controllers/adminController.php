<?php

class adminController extends http\controller
{
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            //PRINT $adminName;
            $password = $_POST['password'];
            //PRINT $password;
            $drpDown =  $_POST['adminDropDown'];
            //PRINT $drpDown;


            $resultSet = studentOrderInfo::getDataForExcel();
            self::getTemplate('adminHomepage', NULL, $resultSet);
            
        }
    }

    public static function export()
    {

        if(isset($_POST["btnExport"])) {

            $startDate = $_POST['event_startDate'];
            print $startDate;
            $endDate = $_POST['event_endDate'];
            print $endDate;
            //$resultSet =  courses::findArchitectureCourses('Architecture');
            $resultSet = studentOrderInfo::getDataForExcel($startDate,$endDate);
            $finalArray = array();

            foreach ($resultSet as $item){
                $itemArray = array( array('Order Number' => $item->orderNum,'Student Name' => $item->studentName,'Student Email' => $item ->studentEmail,
                    'Parent Name' => $item->parentName, 'Course Amount' => $item ->courseAmt, 'Payment Type' => $item ->paymentType,'Amount Paid' => $item ->amtPaid,
                    'Due Amount' => $item ->dueAmt, 'School Name' => $item ->schoolName, 'Street Address' => $item ->streetAddress,'city' => $item ->city,
                    'State' => $item ->state,'Zip Code' => $item ->zipCode,'Order Confirmed' => $item ->orderConfirmed,'Timestamp' => $item ->timestamp,
                    'Payment Status' => $item ->paymentStatus,'Confirmed Timestamp' => $item ->confirmedTimestamp));

                $finalArray[] = $itemArray;
            }

            $filename = "NJIT_File_Test".date('Ymd') . ".xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");

            //echo var_dump($itemArray)."<br>";
            $isColumn = false;
            if(!empty($finalArray)) {
                foreach($finalArray as $value) {

                        if(!$isColumn) {
                            print implode("\t", array_keys($value[0])) . "\n";
                            $isColumn = true;
                        }

                        print implode("\t", array_values($value[0])) . "\n";
                    }
                }
            }
            exit;
        }

            //$data = courses::findArchitectureCourses('Architecture');
            //self::getTemplate('adminHomepage', NULL, $data);

    public static function viewRegistrations()
    {
        $resultSet = studentInfo::getStudentInfo();
        self::getTemplate('adminHomepage', NULL, $resultSet);
    }
}