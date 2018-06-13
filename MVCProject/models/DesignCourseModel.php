<?php

final class todo extends database\model
{
    public $Session;
    public $Description;
    public $StartDate;
    public $EndDate;
    public $ResidentialPrice;
    public $CommuterPrice;

    protected static $modelName = 'DesignCourseModel';

    public static function getTablename()
    {

        $tableName = 'DesignCourseMaster';
        return $tableName;
    }
}

?>
