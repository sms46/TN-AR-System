<?php

class courses extends database\collection
{
    protected static $modelName = 'CoursesModel';

    //Static Functions
    static public function findArchitectureCourses($dept)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE Department = ?';
        return self::getResults($sql, $dept);
    }

    static public function findDesignCourses($dept)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE Department = ?';
        return self::getResults($sql, $dept );
    }

    static public function findCourses()
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
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
}
?>
