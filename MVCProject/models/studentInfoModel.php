<?php

final class studentInfoModel extends \database\model
{
    public $studentName;
    public $studentEmail;
    public $parentName;
    public $schoolName;
    public $streetAddress;
    public $city;
    public $state;
    public $zipCode;

    protected static $modelName = 'studentInfoModel';

    public static function getTablename()
    {
        $tableName = 'studentInfo';
        return $tableName;
    }

    //to find a users tasks you need to create a method here.  Use $this->id to get the usersID For the query
    public static function findTasks()
    {

        //I am temporarily putting a findall here but you should add a method to todos that takes the USER ID and returns their tasks.
        $records = todos::findAll();
        print_r($records);
        return $records;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
