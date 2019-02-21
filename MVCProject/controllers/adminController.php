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

    public static function exportStudentInfo()
    {

        if(isset($_POST["btnExport"])) {

            $statusType = $_POST['statusTypeSelect'];
            $dropDown = $_POST['DropDownList1'];

            //Get the Result set for data to be exported in excel
            $resultSet = studentInfo::getDataForExcel($statusType,$dropDown);
            $finalArray = array();

            foreach ($resultSet as $item){
                $itemArray = array( array('Order Number' => $item->orderNum,'Student Name' => $item->studentName,'Student Email' => $item ->studentEmail,
                    'Gender' => $item ->gender, 'Parent Email' => $item ->parentEmail,'Parent Name' => $item ->parentName,
                    'Parent Number' => $item ->parentNumber,'Street Address' => $item ->streetAddress,'City' => $item ->city,
                    'State' => $item ->state,'Zip Code' => $item ->zipCode, 'Payment Type' => $item ->paymentType,
                    'Order Confirmed' => $item ->orderConfirmed, 'Payment Status' => $item ->paymentStatus));

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