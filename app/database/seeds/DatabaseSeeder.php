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
 
        Bike::create(array(
            'description'   => 'Has a coaster brake',
            'photo'    => 'http://media.tumblr.com/007a6b5111a276afefc497f5e494d898/tumblr_inline_mubo67Imcy1qg88vl.jpg',
            'lost_date'    => '2013-12-27',
        ));
 
    }
 
}



class SentrySeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();
 
        Sentry::getUserProvider()->create(array(
            'email'       => 'seth@doercreator.com',
            'password'    => "drankglowfinflagfred",
            'first_name'  => 'Seth',
            'last_name'   => 'Archambault',
            'activated'   => 1,
        ));
 
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array('admin' => 1),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('seth@doercreator.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);
    }
 
}