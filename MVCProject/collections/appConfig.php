<?php

class appConfig extends database\collection
{
    protected static $modelName = 'appConfigModel';

    //Static Functions

    //Get App Name based on the app id passed
    public static function getAppName($appId)
    {
        $sql = "SELECT * FROM appConfig 
                WHERE id = '$appId'";
        return self::getResults($sql,NULL);
    }

}
?>
