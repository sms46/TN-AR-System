<?php

class productPrice extends database\collection
{
    protected static $modelName = 'productPriceModel';

    //Static Functions

    //Gets the price type for the given product id
    public static function getPriceType($productId)
    {
        $sql = "SELECT * FROM productPrice 
                WHERE product_id = '$productId'";
        return self::getResults($sql,NULL);
    }

    //Gets the session info for the product to be added
    public static function getSessionInfo($productByCode, $prodId)
    {
        $strPrice = productPrice::getPriceType($prodId);
        $price = $strPrice[0]->price;
        $priceId = $strPrice[0]->price_id;

        $itemArrayPrice = array('id' => $productByCode->id,'Session' => $productByCode->sort_count,'Name' => $productByCode->name,
                                    'Category' => $productByCode->categories,'Description' => $productByCode->description, 'Price' => $price, 'PriceId' => $priceId,
                                    'app_id' => $productByCode->app_id,'Seat Available' => $productByCode->item_remain);

        return $itemArrayPrice;
    }
}
?>
