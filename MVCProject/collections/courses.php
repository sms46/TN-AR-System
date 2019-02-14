<?php

class courses extends database\collection
{
    protected static $modelName = 'CoursesModel';

    //Static Functions
    static public function findArchitectureCourses()
    {
        $sql = "SELECT * FROM courses 
                WHERE Department = 'Architecture'
                AND Active = 1";
        return self::getResults($sql,NULL);
    }

    static public function findDesignCourses()
    {
        $sql = "SELECT * FROM courses 
                WHERE Department = 'Design + Make'
                AND Active = 1";
        return self::getResults($sql,NULL);
    }

    static public function findInteriorCourses()
    {
        $sql = "SELECT * FROM courses 
                WHERE Department = 'Interior Design'
                AND Active = 1";
        return self::getResults($sql, NULL);
    }

    static public function findGraphicDesignCourses()
    {
        $sql = "SELECT * FROM courses 
                WHERE Department = 'Graphic Design'
                AND Active = 1";
        return self::getResults($sql,NULL);
    }

    static public function findDigitalDesignCourses()
    {
        $sql = "SELECT * FROM courses 
                WHERE Department = 'Digital Design'
                AND Active = 1";
        return self::getResults($sql, NULL);
    }

    static public function findCourses()
    {
        $sql = "SELECT * FROM courses
                WHERE Active = 1";
        return self::getResults($sql);
    }

    static public function findOneSession($sessionId)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = ?';
        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $sessionId);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }

    static public function findAvailableSeats($course, $startDate)
    {
        //to-do: pass appName for different application
        $appName = 'COAD';
        $availableSeats  =  courses::getAvailableSeats($course,$startDate,$appName);
        $seats = $availableSeats[0];
        $string = implode($seats);
        return $string;
    }

    static public function getAvailableSeats($course, $startDate,$appName)
    {
        $sql = "SELECT SeatAvailable FROM courses WHERE Description = '$course' AND StartDate = '$startDate' AND appName = '$appName'";
        return self::getResults($sql);
    }
}
?>
