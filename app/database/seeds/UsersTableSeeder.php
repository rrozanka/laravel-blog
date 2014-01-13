<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
            ['firstname' => 'Rafal', 'lastname' => 'Rozanka', 'email' => 'rafal.rozanka@gmail.com', 'password' => '']
		);

		// Uncomment the below to run the seeder
		// DB::table('users')->insert($users);
	}

}
