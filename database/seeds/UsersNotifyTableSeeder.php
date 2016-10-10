<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserNotify;

class UsersNotifyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('weathers')->delete();

        $userNotifies = array(
            ['user_id' => 5, 'count' => 4, 'is_viewed' => false ],
            ['user_id' => 6, 'count' => 1, 'is_viewed' => false ],
            ['user_id' => 7, 'count' => 2, 'is_viewed' => false ]
        );

        foreach ($userNotifies as $userNotify)
        {
            UserNotify::create($userNotify);
        }

        Model::reguard();
    }
}
