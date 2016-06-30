<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSrcReferenceColumnToTranslations extends Migration
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
            $table->string('source', 256)->nullable();
            $table->unique(['locale','group','key'], 'ixk_ltm_translations_locale_group_key');
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
            if (Schema::connection('sqlite')->hasColumn('ltm_translations', 'source')) {
                $table->dropColumn('source');
            }
            //$table->dropIndex('ixk_ltm_translations_locale_group_key');
        });
    }
}
