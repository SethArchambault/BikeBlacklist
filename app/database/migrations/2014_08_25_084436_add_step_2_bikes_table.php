<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStep2BikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bikes', function($table) {
			$table->string('bike_placement');
			$table->string('lock_type');
			$table->string('lock_method');
			$table->string('theft_desc');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bikes', function($table) {
			$table->dropColumn('bike_placement');
			$table->dropColumn('lock_type');
			$table->dropColumn('lock_method');
			$table->dropColumn('theft_desc');
		});
	}

}
