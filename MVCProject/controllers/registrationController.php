<?php
//each page extends controller and the index.php?page=tasks causes the controller to be called
class registrationController extends http\controller
{

    public static function register()
    {
        if(isset($_POST["proceed_to_payment"]) && isset ($_POST["paymentTypeSelect"])) {

            $orderNo = strtoupper(studentInfo::randomCode(6));
            self::getTemplate('studentRegistration',$orderNo, $orderNo);
        }
    }

    public static function storeStudentInfo(){

        if(isset($_POST["save_details"])) {

            //Insert into the student info table
            $user = new studentInfoModel();
            $user->studentName = $_POST['studentName'];
            $user->studentEmail = $_POST['email'];
            $user->parentName = $_POST['parentName'];
            $user->schoolName = $_POST['highSchool'];
            $user->streetAddress = $_POST['streetAddress'];
            $user->city = $_POST['city'];
            $user->state = $_POST['state'];
            $user->zipCode = $_POST['zipCode'];
            $user->save();

            //Insert into the student - order table
            $order = new studentOrderInfoModel();
            $order->orderNum = $_POST['orderNum'];
            $order->studentName = $_POST['studentName'];
            $order->studentEmail = $_POST['email'];
            $order->parentName = $_POST['parentName'];
            $order->courseAmt = $_POST['courseAmt'];
            $order->paymentType = $_POST['paymentTypeSelect'];
            $order->dueAmt = $_POST['dueAmt'];
            $order->schoolName = $_POST['highSchool'];
            $order->streetAddress = $_POST['streetAddress'];
            $order->zipCode = $_POST['zipCode'];
            $order->timestamp = studentInfo::getTimestamp();
            $order->orderConfirmed = 'N';
            $order->paymentStatus = '0';
            $order->save();

            self::getTemplate('studentRegistration',NULL, NULL);
       }
    }

    public static function delete() {

        $record = accounts::findOne($_REQUEST['id']);
        $record->delete();
        header("Location: index.php?page=accounts&action=all");
    }
}