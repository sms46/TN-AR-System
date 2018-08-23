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

            //$resultSet =  courses::findArchitectureCourses('Architecture');
            $resultSet = studentOrderInfo::getDataForExcel();
            $finalArray = array();

            foreach ($resultSet as $item){
                $itemArray = array( array('ID' => $item->id,'Order Number' => $item->orderNum,'Student Name' => $item->studentName,'Student Email' => $item ->studentEmail,
                    'Parent Name' => $item->parentName, 'Course Amount' => $item ->courseAmt, 'Payment Type' => $item ->paymentType,'Amount Paid' => $item ->amtPaid,
                    'Due Amount' => $item ->dueAmt, 'School Name' => $item ->schoolName, 'Street Address' => $item ->streetAddress,'city' => $item ->city,
                    'Payment Status' => $item ->paymentStatus));

                $finalArray[] = $itemArray;
            }

            $filename = "NJIT_File_Test".date('Ymd') . ".xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");

            //echo var_dump($itemArray)."<br>";
            $is_coloumn = false;
            if(!empty($finalArray)) {
                foreach($finalArray as $value) {

                        if(!$is_coloumn) {
                            print implode("\t", array_keys($value[0])) . "\n";
                            $is_coloumn = true;
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
        $resultSet = studentOrderInfo::getDataForExcel();
        self::getTemplate('adminHomepage', NULL, $resultSet);
    }
}