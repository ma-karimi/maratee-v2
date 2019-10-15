<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesAuthorsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS species_authors_view');
        \Illuminate\Support\Facades\DB::statement("
      CREATE VIEW species_authors_view AS
      (
        SELECT 
          species_authors.general_id,
            CONCAT_WS (' ',species_name,actor_name) as species_author
            FROM
            (SELECT generals.id as general_id ,generals.name  as species_name ,actors.name  as actor_name FROM generals,actors where generals.type = 'species' and generals.id in (SELECT actorable_id FROM actor_hubs where actorable_type LIKE '%General%')
            ) as species_authors
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
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS species_authors_view');
    }
}
