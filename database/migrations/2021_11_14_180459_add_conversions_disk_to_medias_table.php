<?php

use App\Models\Media;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddConversionsDiskToMediasTable extends Migration
{
    /** * Run the migrations. * * @return void */
    public function up()
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->string('conversions_disk')->nullable();
            $table->char('uuid', 36)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->dropColumn(['conversions_disk', 'uuid']);
        });
    }
}
