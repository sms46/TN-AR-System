<?php

class adminController extends http\controller
{
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            $password = $_POST['password'];
            print 
            self::getTemplate('adminHomepage', null, null);
        }
    }
}