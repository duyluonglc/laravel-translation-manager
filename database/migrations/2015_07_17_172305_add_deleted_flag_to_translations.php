<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDeletedFlagToTranslations extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public
    function up()
    {
        Schema::connection('sqlite')->table('ltm_translations', function (Blueprint $table)
        {
            $table->tinyInteger('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        Schema::connection('sqlite')->table('ltm_translations', function (Blueprint $table)
        {
            $table->dropColumn('is_deleted');
        });
    }

}
