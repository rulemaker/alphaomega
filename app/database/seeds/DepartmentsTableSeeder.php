<?php

class DepartmentsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('departments')->delete();


        $departments = array(
            array(
                'department_name'       => 'IT',
                'notes'      			=> 'This is IT Department',
                'created_at' 			=> new DateTime,
                'updated_at' 			=> new DateTime,
            ),
            array(
                'department_name'       => 'HRD',
                'notes'      			=> 'This is HRD Department',
                'created_at' 			=> new DateTime,
                'updated_at' 			=> new DateTime,
            )
        );

        DB::table('departments')->insert( $departments );
    }

}
