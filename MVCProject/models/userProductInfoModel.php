<?php

final class userProductInfoModel extends \database\model
{
    public $id;
    public $order_num;
    public $user_name;
    public $product_id;
    public $price_id;
    public $timestamp;
    
    protected static $modelName = 'userProductInfoModel';

    public static function getTablename()
    {
        $tableName = 'userProductInfo';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>