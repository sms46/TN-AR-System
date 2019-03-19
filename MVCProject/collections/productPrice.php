<?php

class productPrice extends database\collection
{
    protected static $modelName = 'productPriceModel';

    //Static Functions

    //Gets the price type for the given product id
    public static function getPriceTypeById($prod)
    {
        $sql = "SELECT * FROM productPrice 
                WHERE product_id = '$prod'";
        return self::getResults($sql,NULL);
    }

    //Gets the price type for the given product selected by the user
    public static function getPriceType($priceType,$prod)
    {
        $sql = "SELECT * FROM productPrice 
                WHERE priceType = '$priceType' AND product_id = '$prod'";
        return self::getResults($sql,NULL);
    }

    //Gets the session info for the product to be added
    public static function getSessionInfo($productByCode, $priceType, $prodId)
    {
        $strPrice = productPrice::getPriceType($priceType, $prodId);
        $price = $strPrice[0]->price;
        $priceId = $strPrice[0]->price_id;

        $itemArrayPrice = array($productByCode->id => array('id' => $productByCode->id,'Session' => $productByCode->sort_count,'Name' => $productByCode->name,
                                    'Category' => $productByCode->categories,'Description' => $productByCode->description, 'Price' => $price, 'PriceId' => $priceId,
                                    'app_id' => $productByCode->app_id,'Seat Available' => $productByCode->item_remain));

        return $itemArrayPrice;
    }
}
?>
