<?php

class userProductInfo extends \database\collection
{
    protected static $modelName = 'userProductInfo';

    // Static Functions

    //Gets the current year
    public static function getCurrentYear()
    {
        return date('Y');
    }

    //TO:DO
    public static function getCourseId($courseName, $dept, $startDate)
    {
        $sql = "SELECT id FROM courses 
                WHERE Description = '$courseName'
                AND StartDate = '$startDate'
                AND Department = '$dept'";

        return self::getResults($sql);
    }
}