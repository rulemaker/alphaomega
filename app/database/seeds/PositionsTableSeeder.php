<?php

class PositionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('positions')->delete();


        $positions = array(
            array(
                'position_name' 	    => 'Manager',
                'notes'      			=> 'This is manager position for department',
                'created_at' 			=> new DateTime,
                'updated_at' 			=> new DateTime,
            ),
            array(
                'position_name' 	    => 'Staff',
                'notes'      			=> 'This is staff position',
                'created_at' 			=> new DateTime,
                'updated_at' 			=> new DateTime,
            )
        );

        DB::table('positions')->insert( $positions );
    }

}
