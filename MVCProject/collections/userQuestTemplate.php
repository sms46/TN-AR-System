<?php

class userQuestTemplate extends \database\collection
{
    protected static $modelName = 'userQuestTemplateModel';

    // Static Functions

    //Gets the product id to store info
    public static function getUserQuest($appId)
    {
        $sql = "SELECT * FROM userQuestTemplate
                WHERE app_id = '$appId'
                ORDER BY sort_count";

        return self::getResults($sql);
    }
}