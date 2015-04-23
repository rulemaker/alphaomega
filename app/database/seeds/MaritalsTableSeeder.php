<?php

class MaritalsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('maritals')->delete();


        $maritals = array(
            array(
                'marital_name' 		=> 'Marriage',
                'notes'      		=> 'For employee has been marriage',
                'created_at' 		=> new DateTime,
                'updated_at' 		=> new DateTime,
            ),
            array(
                'marital_name' 		=> 'Single',
                'notes'      		=> 'Still single, doesnt have wife/husband',
                'created_at' 		=> new DateTime,
                'updated_at' 		=> new DateTime,
            )
        );

        DB::table('maritals')->insert( $maritals );
    }

}
