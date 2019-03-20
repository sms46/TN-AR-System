<?php

final class serverTimingLogsModal extends \database\model
{
    public $id;
    public $session_id;
    public $orderNum;
    public $addCourseTime;
    public $proceed_payment;
    public $comments;
    public $last_activity;
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
