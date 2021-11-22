<?php

namespace App\Util;

class AppUtil
{
    public static function defaultIfEmpty($var, $default)
    {
        return (!isset($var) || is_null($var) || empty($var)) ? $default : $var;
    }

    public static function checkSpecialCharacterInString($character, $string)
    {
        if (preg_match('/'.$character.'/', $string)){
            return true;
        }
        return false;
    }

    public static function isEmpty($var)
    {
        if(!isset($var) || is_null($var) || empty($var)){
            return true;
        }
        return false;
    }
}