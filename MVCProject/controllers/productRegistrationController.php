<?php

class productRegistrationController extends http\controller
{
    public static function addCourses()
    {
        //Session Variables
        session_start();
        $time = $_SERVER['REQUEST_TIME'];
        $sessionId = session_id();

        if(isset($_POST["add_to_cart"])) {

            //Get one product selected by the user
            $productByCode = products::findOneSession($_REQUEST['code']);
            
            //Get Session Info
            $itemArray = productPrice::getSessionInfo($productByCode, $_POST['priceType'],$_REQUEST['code']);

            //Get the seats available based on the course selected by the user
            $available = products::getAvailability($_REQUEST['name'],$_REQUEST['description']);

            if($available > 0){

                //LOG FOR TEST:
                $logs = new serverTimingLogsModal();
                $logs->session_id = $sessionId;
                $logs->addCourseTime = $time;
                $logs->comments = 'User added a product';
                $logs->timestamp = userInfo::getTimestamp();
                $logs->save();

                //Condition to check if the course has been previously added
                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode->id, array_keys($_SESSION["cart_item"]))) {
                        echo '<script>alert("Product has already been added")</script>';
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }else{
                echo '<script>alert("There are no items available")</script>';
            }
        }

        //Condition added to handle when seats are not available and no session object needs to be sent.
        $app_id = $_REQUEST['app_id'];
        $productPage = products::findProducts($app_id);

        if(!empty($_SESSION["cart_item"])) {
            self::getTemplate('productRegistration', $_SESSION["cart_item"], $productPage);
        }
        else{
            self::getTemplate('productRegistration', $productPage, $productPage);
        }
    }

    public static function removeCourses()
    {
        session_start();

        if(isset($_GET["action"]))
        {
            if($_GET["action"] == "remove")
            {
                if(!empty($_SESSION["cart_item"])) {
                    foreach ($_SESSION["cart_item"] as $keys => $values) {
                        if ($values["id"] == $_GET["code"]) {
                            unset($_SESSION["cart_item"][$keys]);
                            echo '<script>alert("Product Removed")</script>';

                            $app_id = $_REQUEST['app_id'];
                            $productPage = products::findProducts($app_id);
                            self::getTemplate('productRegistration', $_SESSION["cart_item"], $productPage);
                        }
                    }
                }else{
                    echo '<script>alert("Your Session has been expired. Please Try Again")</script>';

                    $app_id = $_REQUEST['app_id'];
                    $productPage = products::findProducts($app_id);
                    self::getTemplate('productRegistration',NULL,$productPage);
                }
            }
        }
    }

    public static function emptyCart()
    {
        session_start();
        unset($_SESSION["cart_item"]);


        $app_id = $_REQUEST['app_id'];
        $productPage = products::findProducts($app_id);
        self::getTemplate('productRegistration',NULL,$productPage);
    }
}