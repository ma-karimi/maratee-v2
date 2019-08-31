<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 8/31/19
 * Time: 11:54 AM
 */

namespace App\Libraries;


use Grimzy\LaravelMysqlSpatial\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CustomBlueprint
{

    public static function generatedBigIntegerVirtual($table,$column, $jsonIndex, $isIndex = false): void
    {
        DB::statement("ALTER TABLE $table ADD $column BIGINT GENERATED ALWAYS AS (json_unquote(json_extract(life_forms,'$.$jsonIndex'))) VIRTUAL");
        if ($isIndex) {
            \Illuminate\Support\Facades\Schema::table($table, function (Blueprint $table) use ($column) {
                $table->index($column);
            });
        }
    }
}