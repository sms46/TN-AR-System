<?php

class Courses extends database\collection
{
    protected static $modelName = 'CoursesModel';

    //Static Functions
    static public function findCourses()
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        return self::getResults($sql);
    }

    static public function findOneSession($sessionId)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE Session = ?';
        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $sessionId);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }
}
?>
