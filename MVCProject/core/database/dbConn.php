<?php

namespace database;
//singleton pattern
class dbConn
{
    //variable to hold connection object.
    protected static $db;

    //private construct - class cannot be instantiated externally.
    private function __construct()
    {
        try {
            // assign PDO object to db variable
            self::$db = new \PDO('mysql:host=' . CONNECTION . ';dbname=' . DATABASE, USERNAME, PASSWORD);
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\Exception $exception) {
            //echo "Connection Error: " . $e->getMessage();?>
            <html>
                <?php include 'headers.php';?>
                <h1 class="text-danger"> We are facing Technical Issues. Please Try again later</h1>
            </html>
            <?php
        }
    }

    // get connection function. Static method - accessible without instantiation
    public static function getConnection()
    {
        //Guarantees single instance, if no connection object exists then create one.
        if (!self::$db) {
            //new connection object.
            new dbConn();
        }
        //return connection.
        return self::$db;
    }
}

?>
