<?php

final class serverTimingLogsModal extends \database\model
{
    public $id;
    public $sessionId;
    public $orderNum;
    public $addCourseTime;
    public $proceedPayment;
    public $comments;
    public $lastActivity;
    public $timestamp;

    protected static $modelName = 'serverTimingLogsModal';

    public static function getTablename()
    {
        $tableName = 'serverTimingLogs';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
