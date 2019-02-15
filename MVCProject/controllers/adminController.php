<?php

class adminController extends http\controller
{
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            $password = $_POST['password'];

            //Check the user in the DB
            $user = adminAccounts::findUser($adminName);


            if ($user == FALSE) {
                echo '<script>alert("No User Found")</script>';
                self::getTemplate('landingPage', NULL, NULL);
            } else {

                if($user->checkPassword($password) == TRUE) {

                    $resultSet = studentOrderInfo::getRegisteredStudentInfo();
                    self::getTemplate('adminHomepage', NULL, $resultSet);

                } else {
                    echo '<script>alert("Password does not match")</script>';
                    self::getTemplate('landingPage', NULL, NULL);
                }
            }
        }
    }

    public static function createLogin()
    {
        if(isset($_POST["btnRequest"])) {
            $adminName = $_POST['userName'];
            $password = $_POST['password'];
            $appKey = $_POST['adminDropDown'];

            //Check the user in the DB
            $user = adminAccounts::findUser($adminName);

            if ($user == FALSE) {
                $user = new adminAccountsModel();
                $user->userName = $adminName;
                $user->password = $user->setPassword($password);
                $user->appName = $appKey;
                $user->hasAccess = 0;

                $user->save();

                header("Location: index.php");

            } else {
                echo '<script>alert("User already registered")</script>';
                self::getTemplate('landingPage', NULL, NULL);
            }
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
                    'Course Amount' => $item ->courseAmt, 'Payment Type' => $item ->paymentType,'Amount Paid' => $item ->amtPaid,
                    'Due Amount' => $item ->dueAmt,'Order Confirmed' => $item ->orderConfirmed,'Timestamp' => $item ->timestamp,
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

    public static function viewRegistrations()
    {
        $resultSet = studentOrderInfo::getRegisteredStudentInfo();
        self::getTemplate('adminHomepage', NULL, $resultSet);
    }

    public static function viewPartialPayment()
    {
        $result = studentOrderInfo::getPartialPayment();
        self::getTemplate('adminHomepage', NULL, $result);
    }

    public static function viewCourses()
    {
        $result = studentOrderInfo::getCoursesAdmin();
        self::getTemplate('adminHomepage', NULL, $result);
    }

    public static function viewCoursesInfo()
    {
        $result = studentOrderInfo::getCoursesInfoAdmin();
        self::getTemplate('adminHomepage', NULL, $result);
    }
}