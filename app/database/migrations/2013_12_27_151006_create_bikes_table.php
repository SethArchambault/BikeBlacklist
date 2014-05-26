<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bikes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('bike_uid');
			$table->string('description');
			$table->tinyInteger('status');
			$table->string('photo');
			$table->date('lost_date');
			$table->string('found_key');
			$table->date('found_date');
			$table->text('found_story');
			$table->string('email');
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
		Schema::drop('bikes');
	}

}