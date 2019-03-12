<?php

class adminController extends http\controller
{
    //Function to validate a user in db based on appId
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            $password = $_POST['password'];
            $appKey = $_POST['adminDropDown'];

            //Check the user in the DB
            $user = adminAccounts::findUser($adminName, $appKey);

            if ($user == FALSE) {
                echo '<script>alert("No User Found")</script>';
                self::getTemplate('landingPage', NULL, NULL);
            } else {

                if($user->checkPassword($password) == TRUE) {

                    //to-do: Fetch the app id for title on homepage
                    $resultSet = studentOrderInfo::getRegisteredStudentInfo();
                    self::getTemplate('adminHomepage', NULL, $resultSet);

                } else {
                    echo '<script>alert("Password does not match")</script>';
                    self::getTemplate('landingPage', NULL, NULL);
                }
            }
        }
    }

    //Function to add a user in db when a user admin request an access
    public static function createLogin()
    {
        if(isset($_POST["btnRequest"])) {
            $adminName = $_POST['userName'];
            $password = $_POST['password'];
            $appKey = $_POST['adminDropDown'];

            //Check the user in the DB
            $user = adminAccounts::findUser($adminName, $appKey);

            //Add the user admin if no records found
            if ($user == FALSE) {
                $addUser = new adminAccountsModel();
                $addUser->user_name = $adminName;
                $addUser->password = $addUser->setPassword($password);
                $addUser->app_id = $appKey;
                $addUser->is_admin = 0;
                $addUser->has_access = 0;

                $addUser->save();

                echo '<script>alert("You have successfully requested for an admin access request.")</script>';
                self::getTemplate('landingPage', NULL, NULL);

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