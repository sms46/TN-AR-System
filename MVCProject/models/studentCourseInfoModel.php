<?php

final class studentCourseInfoModel extends \database\model
{
    public $id;
    public $orderNum;
    public $studentName;
    public $course;
    public $department;
    public $startDate;
    public $year;
    public $timestamp;
    public $appName;

    protected static $modelName = 'studentCourseInfoModel';

    public static function getTablename()
    {
        $tableName = 'studentCourseInfo';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>