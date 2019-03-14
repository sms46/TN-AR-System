<?php

class products extends database\collection
{
    protected static $modelName = 'productsModel';

    //Static Functions

    //Get the product details based on app id
    public static function getProductName($appId)
    {
        $sql = "SELECT * FROM products
                WHERE app_id = '$appId'";

        return self::getResults($sql,NULL);
    }

    //Get all the sorted products to be displayed on the product registration page
    public static function findProducts($appId)
    {
        $sql = "SELECT * FROM products
                WHERE app_id = '$appId'
                AND Active = 1
                ORDER BY sort_count";
        return self::getResults($sql);
    }


}
?>
