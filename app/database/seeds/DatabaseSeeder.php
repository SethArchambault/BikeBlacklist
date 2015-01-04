<?php
 
use App\Models\Bike;
 
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('SentrySeeder');
        $this->command->info('Sentry tables seeded!');
 
        $this->call('ContentSeeder');
        $this->command->info('Content tables seeded!');


		// $this->call('UserTableSeeder');
	}

}
 
class ContentSeeder extends Seeder {
 
    public function run()
    {
        DB::table('bikes')->delete();
 
    }
 
}



class SentrySeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        // DB::table('groups')->delete();
        // DB::table('users_groups')->delete();
 
        // Assign user permissions

    }
 
}