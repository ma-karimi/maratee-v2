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

    public static function generatedVirtual($table, $column_name, $json_column, $json_index, $isIndex = false, $column_type='BIGINT'): void
    {
        DB::statement("ALTER TABLE $table ADD $column_name $column_type GENERATED ALWAYS AS (json_unquote(json_extract($json_column,'$.$json_index'))) VIRTUAL");
        if ($isIndex) {
            \Illuminate\Support\Facades\Schema::table($table, function (Blueprint $table) use ($column_name) {
                $table->index($column_name);
            });
        }
    }

    public static function generatedVirtualConcat($table, $column_name, $json_column_indexes, $isIndex = false, $column_type='BIGINT'): void
    {
        $query='';
        foreach ($json_column_indexes as $index => $value) {
            $query.="json_unquote(json_extract($index,'$.$value')), ";
        }
        $query=rtrim($query,', ');
        $query="CONCAT_WS(' ', $query)";
        DB::statement("ALTER TABLE $table ADD $column_name $column_type GENERATED ALWAYS AS ($query) VIRTUAL");
        if ($isIndex) {
            \Illuminate\Support\Facades\Schema::table($table, function (Blueprint $table) use ($column_name) {
                $table->index($column_name);
            });
        }
    }
}