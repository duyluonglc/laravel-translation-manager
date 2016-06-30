<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOriginalColumnToLtrTranslations extends Migration
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
            $table->text('saved_value')->nullable();
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
            $table->dropColumn('saved_value');
        });
    }
}
