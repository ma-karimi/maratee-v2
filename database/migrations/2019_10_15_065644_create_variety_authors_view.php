<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVarietyAuthorsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS variety_authors_view');
        \Illuminate\Support\Facades\DB::statement("
      CREATE VIEW variety_authors_view AS
      (
        SELECT 
          variety_authors.general_id,
            CONCAT_WS (' ',variety_name,actor_name) as variety_author
            FROM
            (SELECT generals.id as general_id ,generals.name  as variety_name ,actors.name  as actor_name FROM generals,actors where generals.type = 'variety' and generals.id in (SELECT actorable_id FROM actor_hubs where actorable_type LIKE '%General%')
            ) as variety_authors
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
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS variety_authors_view');
    }
}
