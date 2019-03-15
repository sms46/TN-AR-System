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

    //Gets one record based on the session id
    public static function findOneSession($sessionId)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = ?';

        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $sessionId);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }
    
    //Get Availability from the products table
    public static function getAvailability($productName,$desc)
    {
        $sql = "SELECT * FROM products 
                WHERE name = '$productName' 
                AND description = '$desc'";
        return self::getResults($sql);
    }
}
?>
