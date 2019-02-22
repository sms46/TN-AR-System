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

            //FIX: Check if the Order No exists in the student order info table
            // to solve the issue of duplicate records saved when user refreshes the page

            $orderCount = studentInfo::getOrderCount($_POST['orderNum']);

            if($orderCount[0]->OrderCount == 0){

                //Insert into the student info table
                $user = new studentInfoModel();
                $user->orderNum = $_POST['orderNum'];
                $user->studentName = $_POST['studentName'];
                $user->gender = $_POST['gender'];
                $user->studentEmail = $_POST['email'];
                $user->parentName = $_POST['parentName'];
                $user->parentEmail = $_POST['parentEmail'];
                $user->parentNumber = $_POST['parentNumber'];
                $user->schoolName = $_POST['highSchool'];
                $user->gradYear = $_POST['gradYear'];
                $user->streetAddress = $_POST['streetAddress'];
                $user->city = $_POST['city'];
                $user->state = $_POST['state'];
                $user->zipCode = $_POST['zipCode'];
                $user->save();

                //fix: Course Amt Update for Student Order Table
                $number = $_POST['courseAmt'];
                $english_format_number = number_format($number, 2, '.', '');

                //Insert into the student - order table
                $order = new studentOrderInfoModel();
                $order->orderNum = $_POST['orderNum'];
                $order->studentName = $_POST['studentName'];
                $order->studentEmail = $_POST['email'];
                $order->paymentType = $_POST['paymentTypeSelect'];
                $order->courseAmt = $english_format_number;
                $order->amtPaid = 0;
                $order->dueAmt =  $_POST['totalAmt'];
                $order->timestamp = studentInfo::getTimestamp();
                $order->orderConfirmed = 'N';
                $order->paymentStatus = '0';
                $order->save();

                //Insert into the student course info table
                foreach($_SESSION['cart_item'] as $key=>$item)
                {
                    $courseName = $item['Description'];
                    $deptName = $item['Department'];
                    $startDate = $item['StartDate'];

                    $getCourseId = studentCourseInfo::getCourseId($courseName, $deptName, $startDate );
                    $courseId = $getCourseId[0]->id;

                    //Insert into the course Info table
                    $studentInfo = new studentCourseInfoModel();
                    $studentInfo->orderNum = $_POST['orderNum'];
                    $studentInfo->courseId = $courseId;
                    $studentInfo->studentName = $_POST['studentName'];
                    $studentInfo->regType = $item['Price'];
                    $studentInfo->timestamp = studentInfo::getTimestamp();
                    $studentInfo->save();
                }

                //LOG USER INFO
                $log = new userLogsModel();
                $log->EXT_TRANS_ID = $_POST['orderNum'];
                $log->studentName = $_POST['studentName'];
                $log->studentEmail = $_POST['email'];
                $log->amtPaid = 0;
                $log->balanceAmt = $_POST['totalAmt'];
                $log->paymentStatus = 'Ready to pay using Touchnet';
                $log->description = 'Student data saved. Pending Payment';
                $log->currentTimestamp = studentInfo::getTimestamp();
                $log->save();

                //FIX: Need to save the order no in a variable to pass the same no throughout a session.
                $orderNum = $_POST['orderNum'];
                self::getTemplate('studentRegistration',$orderNum, $orderNum);

            } else{

                $orderNum = $_POST['orderNum'];
                self::getTemplate('studentRegistration',$orderNum, $orderNum);
            }
       }
    }
}