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
			$table->string('description');
			$table->string('photo');
			$table->date('lost_date');
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