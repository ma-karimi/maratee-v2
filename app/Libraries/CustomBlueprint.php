<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 8/31/19
 * Time: 11:54 AM
 */

namespace App\Libraries;


use Grimzy\LaravelMysqlSpatial\Schema\Blueprint as mysqlBluePrint;
use Illuminate\Support\Facades\DB;
use Phaza\LaravelPostgis\Schema\Blueprint as postgresBluePrint;

class CustomBlueprint
{

    public static function generatedVirtual($table, $column_name, $json_column, $json_index, $isIndex = false, $column_type = 'BIGINT'): void
    {
        if (DB::getDefaultConnection() !== 'pgsql') {
            DB::statement("ALTER TABLE $table ADD $column_name $column_type GENERATED ALWAYS AS (json_unquote(json_extract($json_column,'$.$json_index'))) VIRTUAL");
            if ($isIndex) {
                \Illuminate\Support\Facades\Schema::table($table, function (mysqlBluePrint $table) use ($column_name) {
                    $table->index($column_name);
                });
            }
        } else if ($isIndex) {
            /*   DB::statement("CREATE OR REPLACE FUNCTION $column_name($table) RETURNS text AS $$
                      SELECT $1.$json_column->>$json_index;
                      $$ LANGUAGE SQL");*/
            DB::statement("CREATE INDEX ON $table(($json_column->>'$json_index'))");
        }

    }

    public static function generatedVirtualConcat($table, $column_name, $json_column_indexes, $isIndex = false, $column_type = 'BIGINT'): void
    {
        if (DB::getDefaultConnection() !== 'pgsql') {
            $query = '';
            foreach ($json_column_indexes as $index => $value) {
                $query .= "json_unquote(json_extract($index,'$.$value')), ";
            }
            $query = rtrim($query, ', ');
            $query = "CONCAT_WS(' ', $query)";
            DB::statement("ALTER TABLE $table ADD $column_name $column_type GENERATED ALWAYS AS ($query) VIRTUAL");
            if ($isIndex) {
                \Illuminate\Support\Facades\Schema::table($table, function (mysqlBluePrint $table) use ($column_name) {
                    $table->index($column_name);
                });
            }
        }
        else if ($isIndex) {
            foreach ($json_column_indexes as $index => $value) {
                DB::statement("CREATE INDEX ON $table(($index->>'$value'))");
            }

        }
    }
}