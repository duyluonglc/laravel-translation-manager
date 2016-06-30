<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::connection('sqlite')->create('ltm_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->tinyInteger('status')->default(0);
            $table->string('locale', 32);
            $table->string('group', 128);
            $table->string('key', 128);
            $table->text('value')->nullable();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::connection('sqlite')->drop('ltm_translations');
	}

}
