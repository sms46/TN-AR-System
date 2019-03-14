<?php

class homepageController extends http\controller
{
    //Redirects to the landing page
    public static function showDefault()
    {
        self::getTemplate('landingPage', NULL, NULL);
    }

    //Redirects to the product registration page
    public static function redirectToProduct()
    {
        $appKey = $_REQUEST['id'];

        //Find all the products to display
        $productRegister = products::findProducts($appKey);
        self::getTemplate('productRegistration',NULL,$productRegister);
    }
}

