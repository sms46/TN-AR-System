<?php

class studentInfo extends \database\collection
{
    protected static $modelName = 'studentInfo';

    public static function randomCode($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}