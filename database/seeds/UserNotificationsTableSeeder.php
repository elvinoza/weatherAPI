<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class UserNotificationsTableSeeder extends Seeder
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

        $userNotifications = array(
            ['user_id' => 5, 'disease_model_id' => 1, 'short_message' => 'short message1', 'full_message' => 'full message full message full message1', 'is_viewed' => false, 'is_read' => false, 'is_valid' => true],
            ['user_id' => 5, 'disease_model_id' => 1, 'short_message' => 'short message2', 'full_message' => 'full message full message full message2', 'is_viewed' => false, 'is_read' => false, 'is_valid' => true],
            ['user_id' => 5, 'disease_model_id' => 1, 'short_message' => 'short message3', 'full_message' => 'full message full message full message3', 'is_viewed' => false, 'is_read' => false, 'is_valid' => true],
            ['user_id' => 5, 'disease_model_id' => 1, 'short_message' => 'short message4', 'full_message' => 'full message full message full message4', 'is_viewed' => false, 'is_read' => false, 'is_valid' => true],
        );

        foreach ($userNotifications as $notification)
        {
            Notification::create($notification);
        }

        Model::reguard();
    }
}
