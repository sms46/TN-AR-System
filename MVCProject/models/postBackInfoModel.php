<?php

final class postBackInfoModel extends \database\model
{
    public $id;
    public $tpg_trans_id;
    public $pmt_status;
    public $pmt_amt;

    protected static $modelName = 'postBackInfoModel';

    public static function getTablename()
    {
        $tableName = 'postBackInfo';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>