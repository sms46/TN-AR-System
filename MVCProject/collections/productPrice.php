<?php

class productPrice extends database\collection
{
    protected static $modelName = 'productPriceModel';

    //Static Functions
    
    //TO-DO:
    public static function getPrice($priceType)
    {
        $sql = "SELECT id, name FROM productPrice 
                WHERE priceType = '$priceType'";
        return self::getResults($sql,NULL);
    }

    public static function getSessionInfo($productByCode, $priceType)
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
