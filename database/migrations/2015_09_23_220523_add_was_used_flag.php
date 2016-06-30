<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWasUsedFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlite')->table('ltm_translations', function (Blueprint $table)
        {
            $table->tinyInteger('was_used')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlite')->table('ltm_translations', function (Blueprint $table)
        {
            $table->dropColumn('was_used');
        });
    }
}
