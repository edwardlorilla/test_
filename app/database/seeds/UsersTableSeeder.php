<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        // Populate the users table
        DB::table('users')->delete();


        $users = array(
            array(
                'username'                      => 'testuser1',
                'email'                         => 'testuser1@ilys.com',
                'password'                      => Hash::make('password'),
                'confirmed'                     => 1,
                'confirmation_code'             => md5(microtime().Config::get('app.key')),
                'free_trial_word_count_limit'   => Config::get('app.free_trial_word_count_limit'),
                'created_at'                    => new DateTime,
                'updated_at'                    => new DateTime,
            )
        );

        DB::table('users')->insert( $users );
    }

}
