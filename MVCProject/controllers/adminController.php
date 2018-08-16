<?php

class adminController extends http\controller
{
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            PRINT $adminName;
            $password = $_POST['password'];
            PRINT $password;
            $drpDown =  $_POST['adminDropDown'];
            PRINT $drpDown;
            //self::getTemplate('adminHomepage', NULL, NULL);


            $user = accounts::findUserbyEmail($_REQUEST['email']);
            print_r($user);
            $tasks = accounts::findTasksbyID($_REQUEST['ownerid']);
            print_r($tasks);


            if ($user == FALSE) {
                echo 'user not found';
            } else {

                if($user->checkPassword($_POST['password']) == TRUE) {

                    $_SESSION["userID"] = $user->id;

                    //forward the user to the show all todos page
                    print_r($_SESSION);
                } else {
                    echo 'password does not match';
                }
            }
        }
    }
}