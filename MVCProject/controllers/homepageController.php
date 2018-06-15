<?php

class homepageController extends http\controller
{

    public static function show()
    {
        $architectureRecords = ArchitectureCourseMaster::findAll();
        self::getTemplate('homepage', $architectureRecords,$architectureRecords);
    }

    public static function showDesign()
    {
        $designRecords = DesignCourseMaster::findAll();
        self::getTemplate('homepage', $designRecords, $designRecords );
    }

    public static function registerArchitecture()
    {
        $architectureRecordsRegister = ArchitectureCourseMaster::findCourses();
        self::getTemplate('courseRegistration',null,$architectureRecordsRegister);
    }

    public static function addCourses()
    {
        session_start();
        $actionName= $_REQUEST['action'];
        print_r($actionName);

        if(isset($_POST["add_to_cart"])) {
            $productByCode = ArchitectureCourseMaster::findOneSession($_REQUEST['code']);
            //print_r($productByCode);
            $itemArray = array($productByCode['Session'] => array('Session' => $productByCode["Session"], 'Description' => $productByCode["Description"], 'StartDate' => $productByCode["StartDate"]));

            if (!empty($_SESSION["cart_item"])) {

                if (in_array($productByCode["Session"], array_keys($_SESSION["cart_item"]))) {
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
            $architectureRecordsRegister = ArchitectureCourseMaster::findCourses();
            self::getTemplate('courseRegistration', $_SESSION["cart_item"], $architectureRecordsRegister);

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
                        if($values["Session"] == $_GET["code"])
                        {
                            unset($_SESSION["cart_item"][$keys]);
                            echo '<script>alert("Item Removed")</script>';

                            $architectureRecordsRegister = ArchitectureCourseMaster::findCourses();
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

        $architectureRecordsRegister = ArchitectureCourseMaster::findCourses();
        self::getTemplate('courseRegistration', null ,$architectureRecordsRegister);
    }


    public static function create()
    {
        print_r($_POST);
    }

}
