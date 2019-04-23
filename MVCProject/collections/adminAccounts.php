<?php

class adminAccounts extends \database\collection
{
    protected static $modelName = 'adminAccountsModel';

    // Static Functions

    //Check if the user exists in the records
    public static function findUser($name, $appId)
    {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' 
                WHERE user_name = ? 
                AND app_id = '. $appId .'';

        //grab the only record for find one and return as an object
        $recordsSet = self::getResults($sql, $name);

        if (is_null($recordsSet)) {
            return FALSE;
        } else {
            return $recordsSet[0];
        }
    }

    //Check if the user exists in the records
    public static function findUserAccess($appId)
    {
        $sql = "SELECT user_name FROM adminAccounts
                WHERE app_id = '$appId'
                AND has_access = 0";
        return self::getResults($sql,NULL);
    }

    //Get the Application info to transfer to the product registration page
    public static function getAppNameId()
    {
        $sql = "SELECT * FROM appConfig";
        return self::getResults($sql,NULL);
    }

}