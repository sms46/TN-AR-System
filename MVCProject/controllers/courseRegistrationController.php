<?php

class courseRegistrationController extends http\controller
{
    public static function addCourses()
    {
        session_start();
        if(isset($_POST["add_to_cart"])) {

            //Get one course selected by the user
            $productByCode = courses::findOneSession($_REQUEST['code']);

            //Get the seats available based on the course selected by the user
            $availableSeats = courses::findAvailableSeats($_REQUEST['description'],$_REQUEST['startDate']);

            if($availableSeats > 0){

                //Display the price based on selection by the user
                if($_POST["priceType"] == 'Residential Amount')
                {
                    $itemArrayResPrice = array($productByCode['id'] => array('id' => $productByCode["id"],'Description' => $productByCode["Description"],
                        'StartDate' => $productByCode["StartDate"],'EndDate' => $productByCode["EndDate"], 'Price' => $productByCode["ResidentialPrice"],
                        'Department' => $productByCode["Department"], 'appName' => $productByCode["appName"],'SeatAvailable' => $productByCode["SeatAvailable"]));

                    //Condition to check if the course has been previously added
                    if (!empty($_SESSION["cart_item"])) {
                        if (in_array($productByCode["id"], array_keys($_SESSION["cart_item"]))) {
                            echo '<script>alert("Course has already been added")</script>';
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArrayResPrice);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArrayResPrice;
                    }
                } else {

                    $itemArrayComPrice = array($productByCode['id'] => array('id' => $productByCode["id"],'Description' => $productByCode["Description"],
                        'StartDate' => $productByCode["StartDate"],'EndDate' => $productByCode["EndDate"], 'Price' => $productByCode["CommuterPrice"],
                        'Department' => $productByCode["Department"], 'appName' => $productByCode["appName"],'SeatAvailable' => $productByCode["SeatAvailable"]));

                    //Condition to check if the course has been previously added
                    if (!empty($_SESSION["cart_item"])) {
                        if (in_array($productByCode["id"], array_keys($_SESSION["cart_item"]))) {
                            echo '<script>alert("Course has already been added")</script>';
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArrayComPrice);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArrayComPrice;
                    }
                }
            }else{

                echo '<script>alert("There are no seats available for this course")</script>';
            }
        }

        //Condition added to handle when seats are not available and no session object needs to be sent.
        $architectureRecordsRegister = courses::findCourses();

        if(!empty($_SESSION["cart_item"])) {
            self::getTemplate('courseRegistration', $_SESSION["cart_item"], $architectureRecordsRegister);
        }
        else{
            self::getTemplate('courseRegistration', $architectureRecordsRegister, $architectureRecordsRegister);
        }
    }

    public static function removeCourses()
    {
        session_start();
        //print_r($_SESSION["cart_item"]);
        if(isset($_GET["action"]))
        {
            if($_GET["action"] == "remove")
            {
                foreach($_SESSION["cart_item"] as $keys => $values)
                {
                    if($values["id"] == $_GET["code"])
                    {
                        unset($_SESSION["cart_item"][$keys]);
                        echo '<script>alert("Course Removed")</script>';
                        $architectureRecordsRegister = courses::findCourses();
                        self::getTemplate('courseRegistration', $_SESSION["cart_item"],$architectureRecordsRegister);
                    }
                }
            }
        }
    }

    public static function emptyCart()
    {
        session_start();
        unset($_SESSION["cart_item"]);
        $architectureRecordsRegister = courses::findCourses();
        self::getTemplate('courseRegistration', null ,$architectureRecordsRegister);
    }
}