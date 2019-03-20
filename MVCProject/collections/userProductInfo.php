<?php

class userProductInfo extends \database\collection
{
    protected static $modelName = 'userProductInfo';

    // Static Functions

    //Gets the current year
    public static function getCurrentYear()
    {
        return date('Y');
    }

    //Gets the product id to store info
    public static function getProductId($productName, $category, $desc)
    {
        $sql = "SELECT id FROM products 
                WHERE name = '$productName'
                AND description = '$desc'
                AND categories = '$category'";

        return self::getResults($sql);
    }
}