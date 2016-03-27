<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->delete();

        $users = array(
            ['name' => 'name1', 'email' => 'name1@gmail.com', 'password' => Hash::make('secret')],
            ['name' => 'name2', 'email' => 'name2@gmail.com', 'password' => Hash::make('secret')],
            ['name' => 'name3', 'email' => 'name3@gmail.com', 'password' => Hash::make('secret')],
            ['name' => 'name4', 'email' => 'name4@gmail.com', 'password' => Hash::make('secret')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();
    }
}
