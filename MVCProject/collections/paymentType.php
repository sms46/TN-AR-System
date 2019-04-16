<?php

class paymentType extends database\collection
{
    protected static $modelName = 'paymentTypeModel';

    //Static Functions

    //Get the Application info to transfer to the product registration page
    public static function getPaymentTypeById($app_id)
    {
        $sql = "SELECT * FROM paymentType
                WHERE app_id = '$app_id'";

        return self::getResults($sql,NULL);
    }
    
}
?>
