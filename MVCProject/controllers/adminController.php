<?php

class adminController extends http\controller
{
    public static function validateLogin()
    {
        self::getTemplate('adminHomepage',null, null);
    }
}