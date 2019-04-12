<?php

final class userLogsModel extends \database\model
{
    public $id;
    public $EXT_TRANS_ID;
    public $user_name;
    public $user_email;
    public $tpg_trans_id;
    public $amt_paid;
    public $balance_amt;
    public $payment_status;
    public $description;

    protected static $modelName = 'userLogsModel';

    public static function getTablename()
    {
        $tableName = 'userLogs';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
