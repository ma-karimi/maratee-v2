<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/14/19
 * Time: 9:50 AM
 */

namespace App;

class Utility
{
    /**
     * @param int $chars
     * @return bool|string
     */
    public static function randomStringGenerator($chars=6)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        return  substr(str_shuffle($permitted_chars), 0, (int)$chars);
    }
}