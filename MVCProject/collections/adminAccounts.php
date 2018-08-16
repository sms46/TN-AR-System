<?php

class adminAccounts extends \database\collection
{
    protected static $modelName = 'adminAccounts';

    // Static Functions
    public static function randomCode($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    
}