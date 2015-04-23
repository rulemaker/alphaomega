<?php
use Illuminate\Database\Migrations\Migration;

class ConfideSetupUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('users', function($table)
        {
            $table->increments('id');
						$table->string('user_nik',50)->unique();
						$table->tinyInteger('company_id');
						$table->string('firstname',50);
						$table->string('lastname',50);
						$table->string('displayname',100);
						$table->string('gender',10);
						$table->string('identity_no',50); //KTP
						$table->tinyInteger('marital_status');
						$table->string('tax_status',50);
						$table->string('npwp_no',50);
						$table->timestamp('npwp_date');
						$table->string('jamsostek_no',50);
						$table->tinyInteger('department');
						$table->tinyInteger('position');
						$table->string('job_status',11);
						$table->timestamp('joined_date');
						$table->string('birth_place',11);
						$table->timestamp('birth_date');
						$table->string('address');
						$table->string('city',255);
						$table->string('state',255);
						$table->string('country',255);
						$table->string('zipcode',10);
						$table->string('home_phone',20);
						$table->string('mobile_phone',20);
						$table->string('personal_email',100);
						$table->timestamp('ended_date');
						$table->tinyInteger('employee_status');
						$table->string('photo', 255);
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });

        // Creates password reminders table
        Schema::create('password_reminders', function($t)
        {
            $t->string('email');
            $t->string('token');
            $t->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_reminders');
        Schema::drop('users');
    }

}
