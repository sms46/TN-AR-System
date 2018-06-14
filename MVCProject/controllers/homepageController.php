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

    public static function registerDesign()
    {
        $designRecordsRegister = DesignCourseMaster::findAll();
        self::getTemplate('courseRegistration',null,$designRecordsRegister);
    }

    public static function addCourses()
    {
        session_start();
        $actionName= $_REQUEST['action'];
        print_r($actionName);

        if(!empty($actionName)) {
            switch($actionName) {
                case "add":
                        $productByCode = ArchitectureCourseMaster::findOneSession($_REQUEST['code']);
                        //print_r($productByCode);
                        $itemArray = array($productByCode['Session'] => array('Session' => $productByCode["Session"], 'Description' => $productByCode["Description"], 'StartDate' => $productByCode["StartDate"]));

                        if(!empty($_SESSION["cart_item"])) {

                            if(in_array($productByCode["Session"],array_keys($_SESSION["cart_item"]))) {
                               break;
                            } else {
                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                            }
                        }
                        else {
                            $_SESSION["cart_item"] = $itemArray;
                        }
                    break;
                case "remove":
                    if(!empty($_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["Session"] == $k)
                                unset($_SESSION["cart_item"][$k]);
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                        }
                    }
                    break;
                case "empty":
                    unset($_SESSION["cart_item"]);
                    break;
            }
        }

        $architectureRecordsRegister = ArchitectureCourseMaster::findCourses();
        self::getTemplate('courseRegistration', $_SESSION["cart_item"],$architectureRecordsRegister);
    }

    public static function removeCourses()
    {
        session_start();
        $actionName= $_REQUEST['action'];
        print_r($actionName);

        if(!empty($_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["Session"] == $k)
                                unset($_SESSION["cart_item"][$k]);
                            if(empty($_SESSION["cart_item"]))
                               unset($_SESSION["cart_item"]);
                        }
                    }

        $architectureRecords = ArchitectureCourseMaster::findAll();
        self::getTemplate('homepage', $_SESSION["cart_item"],$architectureRecords);
    }

    public static function create()
    {
        print_r($_POST);
    }

}
