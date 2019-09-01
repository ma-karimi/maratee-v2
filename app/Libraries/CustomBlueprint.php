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

    public static function generatedBigIntegerVirtual($table,$column_name, $json_column, $json_index, $isIndex = false): void
    {
        DB::statement("ALTER TABLE $table ADD $column_name BIGINT GENERATED ALWAYS AS (json_unquote(json_extract($json_column,'$.$json_index'))) VIRTUAL");
        if ($isIndex) {
            \Illuminate\Support\Facades\Schema::table($table, function (Blueprint $table) use ($column_name) {
                $table->index($column_name);
            });
        }
    }
}