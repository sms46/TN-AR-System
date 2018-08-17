<?php

class adminController extends http\controller
{
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            //PRINT $adminName;
            $password = $_POST['password'];
            //PRINT $password;
            $drpDown =  $_POST['adminDropDown'];
            //PRINT $drpDown;
            self::getTemplate('adminHomepage', NULL, NULL);
            
        }
    }
}