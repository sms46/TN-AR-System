<?php

final class userLogsModel extends \database\model
{
    public $id;
    public $EXT_TRANS_ID;
    public $studentName;
    public $studentEmail;
    public $tpg_trans_id;
    public $amtPaid;
    public $balanceAmt;
    public $paymentStatus;
    public $description;
    public $currentTimestamp;

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
