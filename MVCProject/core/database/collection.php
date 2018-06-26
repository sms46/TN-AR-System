<?php

namespace database;

abstract class collection
{
    //factory to make model
    static public function create()
    {
        $model = new static::$modelName;
        return $model;
    }

    static public function findAll()
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        return self::getResults($sql);
    }

    static public function findCourses()
    {
        $tableName = 'Courses';
        $sql = 'SELECT * FROM ' . $tableName;
        return self::getResults($sql);
    }

    static public function findOneSession($sessionId)
    {
        $tableName = 'Courses';
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE Session = ?';
        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $sessionId);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }

    //you can use this to run other queries in on classes that extend the collection class because this is protected
    protected static function getResults($sql, $parameters = null) {
        if (!is_array($parameters)) {
            $parameters = (array) $parameters;
        }
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);

        $statement->execute($parameters);
        $class = static::$modelName;

        if ($statement->rowCount() > 0) {
            $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
            $recordsSet = $statement->fetchAll();

        } else {
            $recordsSet = NULL;
        }

        return $recordsSet;
    }

    static public function findOne($id)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = ?';
        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $id);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }

    static public function findUser($username) {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id ="' . $username . '"';
        $recordsSet = self::getResults($sql);
        return $recordsSet[0];
    }
}

?>
