<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullNameView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS full_name_view');
//        \Illuminate\Support\Facades\DB::statement("
//      CREATE VIEW full_name_view AS
//      (
//        SELECT
//        id as user_id,
//        CONCAT_WS(' ', users.last_name::jsonb @>'en',first_name::jsonb @>'en') as full_name
//        from users
//      )
//    "
//
//        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS full_name_view');
    }
}
