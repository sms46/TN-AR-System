<?php

final class courseModel extends \database\model
{
    public $id;
    public $Description;
    public $StartDate;
    public $EndDate;
    public $ResidentialPrice;
    public $CommuterPrice;
    public $Department;
    public $appName;
    public $SeatAvailable;

    protected static $modelName = 'courseModel';

    public static function getTablename()
    {
        $tableName = 'courses';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>