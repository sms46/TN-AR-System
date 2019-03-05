<?php

class coursePrice extends database\collection
{
    protected static $modelName = 'coursePriceModel';

    //Static Functions
    static public function getResidentPrice()
    {
        $sql = "SELECT * FROM coursePrice 
                WHERE priceType = 'Residential'";
        return self::getResults($sql,NULL);
    }

    static public function getCommuterPrice()
    {
        $sql = "SELECT * FROM coursePrice 
                WHERE priceType = 'Commuter'";
        return self::getResults($sql,NULL);
    }
}
?>
