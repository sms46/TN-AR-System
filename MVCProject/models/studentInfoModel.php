<?php

final class studentInfoModel extends \database\model
{
    public $id;
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
    
    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>
