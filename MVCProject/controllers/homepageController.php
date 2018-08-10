<?php

class homepageController extends http\controller
{
    public static function showDefault()
    {
        self::getTemplate('landingPage', NULL, NULL);
    }

    public static function redirectToCoad()
    {
        $records = courses::findCourses();
        self::getTemplate('homepage', NULL, $records);
    }

    public static function getArchitectureCourses()
    {
        $architectureRecords = courses::findArchitectureCourses('Architecture');
        return $architectureRecords;
    }

    public static function getDesignCourses()
    {
        $designRecords = courses::findDesignCourses('Design');
        return $designRecords;
    }

    public static function redirectToCourse()
    {
        $courseRegister = courses::findCourses();
        self::getTemplate('courseRegistration',NULL,$courseRegister);
    }

    public static function create()
    {
        print_r($_POST);
    }
}
