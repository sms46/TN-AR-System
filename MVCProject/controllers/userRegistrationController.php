 <?php

 //Session start initiated on top of the page
  session_start();

//each page extends controller and the index.php?page=tasks causes the controller to be called
class userRegistrationController extends http\controller
{
    //Routes to the user registration page
    public static function register()
    {
        if(isset($_POST["proceed_to_payment"]) && isset ($_POST["paymentTypeSelect"])) {
            
            if(!empty($_SESSION["cart_item"])){

                $orderNo = strtoupper(userInfo::randomCode(6));
                $time = $_SERVER['REQUEST_TIME'];
                $sessionId = session_id();

                //LOG FOR TEST:
                $logs = new serverTimingLogsModal();
                $logs->session_id = $sessionId;
                $logs->orderNum = $orderNo;
                $logs->proceed_payment = $time;
                $logs->comments = 'Session Active.User proceeds to checkout.';
                $logs->timestamp = userInfo::getTimestamp();
                $logs->save();


                self::getTemplate('userRegistration',NULL, $orderNo);
            }else{

                echo '<script>alert("Your Session has been expired. Please Try Again")</script>';

                $app_id = $_REQUEST['app_id'];
                $productPage = products::findProducts($app_id);
                self::getTemplate('productRegistration',NULL,$productPage);
            }
        }
    }

    //stores the user info in db
    public static function storeUserInfo(){

        if(isset($_POST["save_details"])) {

            //FIX: Check if the Order No exists in the student order info table
            // to solve the issue of duplicate records saved when user refreshes the page

            $orderCount = userInfo::getOrderCount($_POST['orderNum']);

            if($orderCount[0]->OrderCount == 0){

                if(!empty($_SESSION["cart_item"])) {

                    //Insert into the user info table
                    $user = new userInfoModel();
                    $user->orderNum = $_POST['orderNum'];
                    $user->user_name = $_POST['studentName'];
                    $user->user_email = $_POST['email'];
                    $user->gender = $_POST['gender'];
                    $user->parent_name = $_POST['parentName'];
                    $user->parent_email = $_POST['parentEmail'];
                    $user->parent_number = $_POST['parentNumber'];
                    $user->school_name = $_POST['highSchool'];
                    $user->grad_year = $_POST['gradYear'];
                    $user->street_address = $_POST['streetAddress'];
                    $user->city = $_POST['city'];
                    $user->state = $_POST['state'];
                    $user->zipCode = $_POST['zipCode'];
                    $user->save();

                    //fix: Course Amt Update for UserOrderInfo Table
                    $number = $_POST['courseAmt'];
                    $english_format_number = number_format($number, 2, '.', '');

                    //Insert into the UserOrderInfo table
                    $order = new userOrderInfoModel();
                    $order->orderNum = $_POST['orderNum'];
                    $order->user_name = $_POST['studentName'];
                    $order->user_email = $_POST['email'];
                    $order->payment_type = $_POST['paymentTypeSelect'];
                    $order->course_amt = $english_format_number;
                    $order->amt_paid = 0;
                    $order->due_amt = $_POST['totalAmt'];
                    $order->timestamp = userInfo::getTimestamp();
                    $order->order_confirmed = 'N';
                    $order->payment_status = '0';
                    $order->save();

                    //Insert into the user product info table
                    foreach ($_SESSION['cart_item'] as $key => $item) {

                        $productName = $item['Name'];
                        $category = $item['Category'];
                        $desc = $item['Description'];
                        $priceId = $item['PriceId'];

                        //Get Product Id
                        $getProductId = userProductInfo::getProductId($productName, $category, $desc);
                        $prodId = $getProductId[0]->id;

                        //Insert into the user product Info table
                        $userProdInfo = new userProductInfoModel();
                        $userProdInfo->order_num = $_POST['orderNum'];
                        $userProdInfo->user_name = $_POST['studentName'];
                        $userProdInfo->product_id = $prodId;
                        $userProdInfo->price_id = $priceId;
                        $userProdInfo->timestamp = userInfo::getTimestamp();
                        $userProdInfo->save();
                    }

                    //LOG USER INFO
                    $log = new userLogsModel();
                    $log->EXT_TRANS_ID = $_POST['orderNum'];
                    $log->user_name = $_POST['studentName'];
                    $log->user_email = $_POST['email'];
                    $log->amt_paid = 0;
                    $log->balance_amt = $_POST['totalAmt'];
                    $log->payment_status = 'Ready to pay using Touchnet';
                    $log->description = 'Student data saved. Pending Payment';
                    $log->save();

                    //LOG FOR TEST:
                    $time = $_SERVER['REQUEST_TIME'];
                    $sessionId = session_id();

                    $logs = new serverTimingLogsModal();
                    $logs->session_id = $sessionId;
                    $logs->orderNum = $_POST['orderNum'];
                    $logs->proceed_payment = $time;
                    $logs->comments = 'Session Active.Current order num saved.User Ready to pay';
                    $logs->timestamp = userInfo::getTimestamp();
                    $logs->save();

                    //FIX: Need to save the order no in a variable to pass the same no throughout a session.
                    $orderNum = $_POST['orderNum'];
                    self::getTemplate('userRegistration', NULL, $orderNum);

                }else{

                    echo '<script>alert("Your Session has been expired. Please Try Again")</script>';
                    $app_id = $_REQUEST['app_id'];
                    $productPage = products::findProducts($app_id);
                    self::getTemplate('productRegistration',NULL,$productPage);
                }

            } else{

                $orderNum = $_POST['orderNum'];
                self::getTemplate('userRegistration',NULL, $orderNum);
            }
       }
    }
}