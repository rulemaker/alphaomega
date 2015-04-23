<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();


        $users = array(
            array(
				'user_nik'      		    => 'IT001',
				'company_id'      	        => '1',
                'firstname'      		    => 'Administrator',
				'lastname'      		    => '',
				'displayname'     	        => 'Administrator',
				'gender'      			    => '1',
				'identity_no'     	        => '123456789',
				'marital_status'  	        => '2',
				'tax_status'      	        => '',
				'npwp_no'      			    => '',
				'npwp_date'      		    => '',
				'jamsostek_no'    	        => '',
				'department'      	        => '1',
				'position'      		    => '1',
				'job_status'      	        => '',
				'joined_date'     	        => '',
				'birth_place'     	        => '',
				'birth_date'      	        => '',
				'address'      			    => '',
				'city'      				=> '',
				'state'      				=> '',
				'country'      			    => '',
				'zipcode'      			    => '',
				'home_phone'      	        => '',
				'mobile_phone'    	        => '',
				'personal_email'  	        => '',
				'ended_date'      	        => '',
				'employee_status' 	        => '1',
				'photo'      				=> '',
				'username'      		    => 'admin',
                'email'      				=> 'admin@example.org',
                'password'   				=> Hash::make('admin'),
                'confirmed'   			    => 1,
                'confirmation_code'         => md5(microtime().Config::get('app.key')),
                'created_at' 				=> new DateTime,
                'updated_at' 				=> new DateTime,
            ),
            array(
                'user_nik'      		    => 'EMP001',
				'company_id'      	        => '1',
                'firstname'      		    => 'User',
				'lastname'      		    => '',
				'displayname'     	        => 'User',
				'gender'      			    => '1',
				'identity_no'     	        => '123456789',
				'marital_status'  	        => '1',
				'tax_status'      	        => '',
				'npwp_no'      			    => '',
				'npwp_date'      		    => '',
				'jamsostek_no'    	        => '',
				'department'      	        => '1',
				'position'      		    => '1',
				'job_status'      	        => '',
				'joined_date'     	        => '',
				'birth_place'     	        => '',
				'birth_date'      	        => '',
				'address'      			    => '',
				'city'      				=> '',
				'state'      				=> '',
				'country'      			    => '',
				'zipcode'      			    => '',
				'home_phone'      	        => '',
				'mobile_phone'    	        => '',
				'personal_email'  	        => '',
				'ended_date'      	        => '',
				'employee_status' 	        => '1',
				'photo'      				=> '',
				'username'                  => 'user',
                'email'                     => 'user@example.org',
                'password'                  => Hash::make('user'),
                'confirmed'                 => 1,
                'confirmation_code'         => md5(microtime().Config::get('app.key')),
                'created_at'                => new DateTime,
                'updated_at'                => new DateTime,
            )
        );

        DB::table('users')->insert( $users );
    }

}
