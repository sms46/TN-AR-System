<?php

class DesignCourseMaster extends database\collection
{
    protected static $modelName = 'todo';

    //This is the function to write to find tasks by user ID for listing on their homepage.
    public static  function findTasksbyID($userid) {

        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE ownerid = ?';

        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $userid);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet;
        }
    }
}
?>
