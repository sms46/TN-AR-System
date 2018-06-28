<?php

//each page extends controller and the index.php?page=tasks causes the controller to be called
class registrationController extends http\controller
{

    public static function register()
    {
        if(isset($_POST["proceed_to_payment"]) && isset ($_POST["paymentTypeSelect"])) {
            self::getTemplate('studentRegistration',NULL, NULL);
        }
    }

    public static function storeStudentInfo(){

        if(isset($_POST["save_details"])) {

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

            self::getTemplate('studentRegistration',NULL, NULL);
       }
    }

    public static function delete() {

        $record = accounts::findOne($_REQUEST['id']);
        $record->delete();
        header("Location: index.php?page=accounts&action=all");
    }
}