<?php

class CompaniesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('companies')->delete();


        $companies = array(
            array(
                'company_name' 		        => 'Alpha Omega Corporate',
				'address'					=> '',
				'city'						=> '',
				'state'						=> 'West Java',
				'country'					=> 'Indonesia',
				'zipcode'					=> '',
				'phone'						=> '',
				'email'						=> 'hello@alphaomega.com',
				'notes'						=> '',
                'created_at' 			    => new DateTime,
                'updated_at' 			    => new DateTime,
            ),
        );

        DB::table('companies')->insert( $companies );
    }

}
