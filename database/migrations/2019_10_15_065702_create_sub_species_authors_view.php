<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubSpeciesAuthorsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS sub_species_authors_view');
        \Illuminate\Support\Facades\DB::statement("
      CREATE VIEW sub_species_authors_view AS
      (
        SELECT 
          sub_species_authors.general_id,
            CONCAT_WS (' ',sub_species_name,actor_name) as sub_species_author
            FROM
            (SELECT generals.id as general_id ,generals.name  as sub_species_name ,actors.name  as actor_name FROM generals,actors where generals.type = 'sub_species' and generals.id in (SELECT actorable_id FROM actor_hubs where actorable_type LIKE '%General%')
            ) as sub_species_authors
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
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS sub_species_authors_view');
    }
}
