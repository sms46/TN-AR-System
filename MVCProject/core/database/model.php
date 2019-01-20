<?php
namespace database;

use http\controller;

abstract class model
{
    public function save()
    {
        if($this->validate() == FALSE) {
           echo 'failed validation';
           exit;
        }

        if ($this->id != '') {
            $sql = $this->update();
        } else {
            $sql = $this->insert();
            //$INSERT = TRUE;
        }
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $array = get_object_vars($this);

        foreach ($array as $key => $value) {
            if (!isset($value)) {
                //echo $key . "is not set <br/>";
                unset($array[$key]);
            }
        }

        foreach (array_keys($array) as $key => $value) {
            $statement->bindParam(":$value", $this->$value);
        }
        $statement->execute();
        return $this->id;
        }

    private function insert()
    {

        $modelName = static::$modelName;
        $tableName = $modelName::getTablename();
        $array = get_object_vars($this);
        //unset($array['id']);
        foreach ($array as $key => $value) {
            if (!isset($value)) {
                unset($array[$key]);
            }
        }

        $columnString = implode(',', array_keys($array));
        $valueString = ':' . implode(',:', array_keys($array));
        $sql = 'INSERT INTO ' . $tableName . ' (' . $columnString . ') VALUES (' . $valueString . ')';
        return $sql;
    }

    public function validate() {

        return TRUE;
    }

    private function update()
    {
        $modelName = static::$modelName;
        $tableName = $modelName::getTablename();
        $array = get_object_vars($this);

        $comma = " ";
        $sql = 'UPDATE ' . $tableName . ' SET ';
        foreach ($array as $key => $value) {
            //if (!empty($value))

            //FIX: To handle 0 for any column in a database.
            if(isset($value))
            {
                $sql .= $comma . $key . ' = "' . $value . '"';
                $comma = ", ";
            }
        }
        $sql .= ' WHERE id=' . $this->id;
        return $sql;

    }

    public function delete()
    {
        $db = dbConn::getConnection();
        $modelName = static::$modelName;
        $tableName = $modelName::getTablename();
        $sql = 'DELETE FROM ' . $tableName . ' WHERE id=' . $this->id;
        $statement = $db->prepare($sql);
        $statement->execute();
    }
}

?>
