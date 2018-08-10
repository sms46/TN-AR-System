<?php

class homepageController extends http\controller
{
    public static function showDefault()
    {
        //$architectureRecords = courses::findArchitectureCourses('Architecture');
        self::getTemplate('landingPage', null,null);
    }
    
    public static function show()
    {
        $architectureRecords = courses::findArchitectureCourses('Architecture');
        self::getTemplate('homepage', $architectureRecords,$architectureRecords);
    }

    public static function showDesign()
    {
        $designRecords = courses::findDesignCourses('Design');
        self::getTemplate('homepage', $designRecords, $designRecords);
    }

    public static function registerArchitecture()
    {
        $architectureRecordsRegister = courses::findCourses();
        self::getTemplate('courseRegistration',null,$architectureRecordsRegister);
    }

    public static function create()
    {
        print_r($_POST);
    }
}
