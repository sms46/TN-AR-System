<?php

final class studentCourseInfoModel extends \database\model
{
    public $id;
    public $orderNum;
    public $courseId;
    public $studentName;
    public $regType;
    public $timestamp;
    
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