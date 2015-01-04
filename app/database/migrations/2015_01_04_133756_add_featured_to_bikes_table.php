<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturedToBikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bikes', function(Blueprint $table)
		{
			Schema::table('bikes', function($table) {
				$table->tinyInteger('featured')->default(1)->unsigned();
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bikes', function(Blueprint $table)
		{
			//
			$table->dropColumn('featured');
		});
	}

}
