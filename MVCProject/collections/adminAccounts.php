<?php

class adminAccounts extends \database\collection
{
    protected static $modelName = 'adminAccountsModel';

    // Static Functions
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
    
}