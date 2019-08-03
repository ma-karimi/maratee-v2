<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/14/19
 * Time: 9:50 AM
 */

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Utility
{
    /**
     * @param int $chars
     * @return bool|string
     */
    public static function randomStringGenerator($chars = 6)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($permitted_chars), 0, (int)$chars);
    }

    public static function truncateTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tableNames as $name) {
            //if you don't want to truncate migrations
            if ($name == 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
