<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('RolesTableSeeder');
    $this->call('PermissionsTableSeeder');
		$this->call('DepartmentsTableSeeder');
		$this->call('MaritalsTableSeeder');
		$this->call('PositionsTableSeeder');
		$this->call('CompaniesTableSeeder');
		
	}

}
