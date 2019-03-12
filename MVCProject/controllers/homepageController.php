<?php

class homepageController extends http\controller
{
    public static function showDefault()
    {
        self::getTemplate('landingPage', NULL, NULL);
    }

    public static function redirectToCoad()
    {
        self::getTemplate('homepage', NULL, NULL);
    }

    public static function redirectToCourse()
    {
        $courseRegister = courses::findCourses();
        self::getTemplate('courseRegistration',NULL,$courseRegister);
    }
}

