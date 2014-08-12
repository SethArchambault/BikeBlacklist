<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bikes', function($table) {
			$table->string('serial_num');
			$table->string('lost_location');
			$table->double('lost_longitude');
			$table->double('lost_latitude');
			$table->string('lost_formatted_address');
			$table->string('lost_street_number');
			$table->string('lost_postal_code');
			$table->string('lost_city');
			$table->string('lost_state');
			$table->string('lost_county');
			$table->string('lost_neighborhood');
			$table->text('admin_notes');
			$table->string('advice');
			$table->double('lost_time');
			$table->double('lost_time_end');
			$table->double('approx_value');
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
			$table->dropColumn('serial_num');
			$table->dropColumn('lost_location');
			$table->dropColumn('lost_longitude');
			$table->dropColumn('lost_latitude');
			$table->dropColumn('lost_formatted_address');
			$table->dropColumn('lost_street_number');
			$table->dropColumn('lost_postal_code');
			$table->dropColumn('lost_city');
			$table->dropColumn('lost_state');
			$table->dropColumn('lost_county');
			$table->dropColumn('lost_neighborhood');
			$table->dropColumn('admin_notes');
			$table->dropColumn('advice');
			$table->dropColumn('lost_time');
			$table->dropColumn('lost_time_end');
			$table->dropColumn('approx_value');
		});
	}

}
