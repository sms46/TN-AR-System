<?php

final class studentCourseInfoModel extends \database\model
{
    public $id;
    public $studentName;
    public $studentEmail;
    public $parentName;
    public $course;
    public $department;
    public $startDate;
    public $year;
    public $schoolName;
    public $streetAddress;
    public $zipCode;
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