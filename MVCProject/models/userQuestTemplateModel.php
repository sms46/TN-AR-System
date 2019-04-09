<?php

final class userQuestTemplateModel extends \database\model
{
    public $id;
    public $quest;
    public $quest_type;
    public $is_required;
    public $app_id;

    protected static $modelName = 'userQuestTemplateModel';

    public static function getTablename()
    {
        $tableName = 'userQuestTemplate';
        return $tableName;
    }

    public function validate()
    {
        $valid = TRUE;
        return $valid;
    }
}
?>