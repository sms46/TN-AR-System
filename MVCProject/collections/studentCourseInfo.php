<?php

class studentCourseInfo extends \database\collection
{
    protected static $modelName = 'studentCourseInfo';

    // Static Functions
    public static function getCurrentYear()
    {
        return date('Y');
    }
}