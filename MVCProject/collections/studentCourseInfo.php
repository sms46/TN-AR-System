<?php

class studentCourseInfo extends \database\collection
{
    protected static $modelName = 'studentCourseInfo';

    // Static Functions
    public static function getCurrentYear()
    {
        return date('Y');
    }

    public static function getCourseId($courseName, $dept, $startDate)
    {
        $sql = "SELECT id FROM courses 
                WHERE Description = '$courseName'
                AND StartDate = '$startDate'
                AND Department = '$dept'";

        return self::getResults($sql);
    }
}