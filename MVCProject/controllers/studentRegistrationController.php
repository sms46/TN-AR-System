 <?php

 //Session start initiated on top of the page
  session_start();

//each page extends controller and the index.php?page=tasks causes the controller to be called
class studentRegistrationController extends http\controller
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
            $order->amtPaid = $_POST['totalAmtPaid'];
            $order->dueAmt = $_POST['dueAmt'];
            $order->schoolName = $_POST['highSchool'];
            $order->streetAddress = $_POST['streetAddress'];
            $order->city = $_POST['city'];
            $order->state = $_POST['state'];
            $order->zipCode = $_POST['zipCode'];
            $order->timestamp = studentInfo::getTimestamp();
            $order->orderConfirmed = 'N';
            $order->paymentStatus = '0';
            $order->save();

            //Insert into the student course info table
            foreach($_SESSION['cart_item'] as $key=>$item)
            {
                $studentInfo = new studentCourseInfoModel();
                $studentInfo->studentName = $_POST['studentName'];
                $studentInfo->studentEmail = $_POST['email'];
                $studentInfo->parentName = $_POST['parentName'];
                $studentInfo->course = $item['Description'];
                $studentInfo->department = $item['Department'];
                $studentInfo->startDate = $item['StartDate'];
                $studentInfo->year = studentCourseInfo::getCurrentYear();
                $studentInfo->schoolName = $_POST['highSchool'];
                $studentInfo->streetAddress = $_POST['streetAddress'];
                $studentInfo->zipCode = $_POST['zipCode'];
                $studentInfo->timestamp = studentInfo::getTimestamp();
                $studentInfo->appName = 'COAD';
                $studentInfo->save();
            }

            //FIX: Need to save the order no in a variable to pass the same no throughout a session.
            $orderNum = $_POST['orderNum'];
            self::getTemplate('studentRegistration',$orderNum, $orderNum);
       }
    }

    //TO-DO: REMOVE METHOD
    public static function delete() {

        $record = accounts::findOne($_REQUEST['id']);
        $record->delete();
        header("Location: index.php?page=accounts&action=all");
    }
}