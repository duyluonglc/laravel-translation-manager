<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSrcReferenceColumnInTranslations extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlite')->table('ltm_translations', function (Blueprint $table) {
            $table->text('source')->nullable()->change();
            $table->boolean('is_auto_added')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlite')->table('ltm_translations', function (Blueprint $table) {
            $table->string('source')->nullable()->change();
            $table->dropColumn('is_auto_added');
        });
    }

}
