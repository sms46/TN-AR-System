<?php

final class postBackInfoModel extends \database\model
{
    public $id;
    public $EXT_TRANS_ID;
    public $UPAY_SITE_ID;
    public $sys_tracking_id;
    public $tpg_trans_id;
    public $name_on_acct;
    public $acct_email_address;
    public $pmt_status;
    public $pmt_amt;
    public $acct_addr;
    public $acct_addr2;
    public $acct_city;
    public $acct_state;
    public $acct_zip;
    public $pmt_date;

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