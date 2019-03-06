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

    static public function getPrice($priceType)
    {
        $sql = "SELECT * FROM coursePrice 
                WHERE priceType = '$priceType'";
        return self::getResults($sql,NULL);
    }

    static public function getSessionInfo($productByCode, $priceType)
    {

        $strPrice = coursePrice::getPrice($priceType);
        $price = $strPrice[0]->price;
        $priceId = $strPrice[0]->pid;

        $itemArrayPrice = array($productByCode['id'] => array('id' => $productByCode["id"],'Session' => $productByCode["Session"],'Description' => $productByCode["Description"],
                                    'StartDate' => $productByCode["StartDate"],'EndDate' => $productByCode["EndDate"], 'Price' => $price,'PriceId' => $priceId,
                                    'Department' => $productByCode["Department"], 'appName' => $productByCode["appName"],'SeatAvailable' => $productByCode["SeatAvailable"]));

        return $itemArrayPrice;
    }
}
?>
