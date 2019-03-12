<?php

class appConfig extends database\collection
{
    protected static $modelName = 'appConfigModel';

    //Static Functions
    static public function getAppName($appId)
    {
        $sql = "SELECT * FROM appConfig 
                WHERE app_id = '$appId'";
        return self::getResults($sql,NULL);
    }

}
?>
