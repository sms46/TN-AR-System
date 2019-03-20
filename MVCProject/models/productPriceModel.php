<?php

final class productPriceModel extends \database\model
{
    public $id;
    public $priceType;
    public $product_id;
    public $price;

    protected static $modelName = 'productPriceModel';

    public static function getTablename()
    {
        $tableName = 'productPrice';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>