<?php

class products extends database\collection
{
    protected static $modelName = 'productsModel';

    //Static Functions

    public static function getProductName($appId)
    {
        $sql = "SELECT * FROM products
                WHERE app_id = '$appId'";

        return self::getResults($sql,NULL);
    }


}
?>
