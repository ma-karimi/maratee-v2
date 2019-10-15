<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScientificView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS scientific_view');
        \Illuminate\Support\Facades\DB::statement("
      CREATE VIEW scientific_view AS
      (
       SELECT taxonomy_id, 
CONCAT_WS(' ', genus_name_en, species_name_en,subspecies_name_en,variety_name_en) as name
FROM (


    SELECT 
    taxonomy_id,
    genus_name as  genus_name_en,
    species_name as species_name_en,
    subspecies_name as subspecies_name_en,
    variety_name as variety_name_en

    FROM (
        SELECT
            t.id taxonomy_id,
            (SELECT name FROM generals g WHERE g.id = t.genus_id) genus_name ,
            (SELECT name FROM generals g WHERE g.id = t.species_id) species_name ,
            (SELECT name FROM generals g WHERE g.id = t.subspecies_id) subspecies_name ,
            (SELECT name FROM generals g WHERE g.id = t.variety_id) variety_name 


        FROM taxonomies t
        ) names
    
    ) scientific_name
      )
    "

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS scientific_view');
    }
}
