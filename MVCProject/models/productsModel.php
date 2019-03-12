<?php

final class productsModel extends \database\model
{
    public $id;
    public $sort_count;
    public $name;
    public $categories;
    public $description;
    public $app_id;
    public $item_remain;
    public $active;

    protected static $modelName = 'productsModel';

    public static function getTablename()
    {
        $tableName = 'products';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>