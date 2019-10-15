<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyAuthorsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS taxonomy_authors_view');
        \Illuminate\Support\Facades\DB::statement("
      CREATE VIEW taxonomy_authors_view AS
      (
       select taxonomy_id , CONCAT_WS (' ',variety_actor,species_actor,subspecies_actor) as authors from
(
select id as taxonomy_id,
( select a.name from actor_hubs ah 
	LEFT JOIN actors a ON ah.actor_id = a.id
where ah.actorable_id = t.variety_id 
AND actorable_type = 'App\Models\General'
LIMIT 1
) variety_actor,
( select a.name from actor_hubs ah 
	LEFT JOIN actors a ON ah.actor_id = a.id
where ah.actorable_id = t.species_id
AND actorable_type = 'App\Models\General'
LIMIT 1
) species_actor,
( select a.name from actor_hubs ah 
	LEFT JOIN actors a ON ah.actor_id = a.id
where ah.actorable_id = t.subspecies_id
AND actorable_type = 'App\Models\General'
LIMIT 1
) subspecies_actor

 from taxonomies t) tt
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
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS taxonomy_authors_view');
    }
}
