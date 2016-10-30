<?php

use App\Models\Notification;

class NotificationTest extends TestCase
{
    /**
     * Create Notification Test.
     *
     * @return void
     */
    public function testCreateNotification()
    {
        $notification = factory(Notification::class)->create();

        $this->seeInDatabase('notifications', [
            'id' => $notification->id,
            'disease_model_id' => $notification->disease_model_id,
            'user_id' => $notification->user_id,
            'short_message' => $notification->short_message,
            'full_message' => $notification->full_message,
            'is_viewed' => $notification->is_viewed,
            'is_read' => $notification->is_read,
            'is_valid' => $notification->is_valid,
        ]);

        $notification->delete();
    }

    /**
     * Delete Notification Test.
     *
     * @return void
     */
    public function testDeleteNotification()
    {
        $notification = factory(Notification::class)->create();

        $this->seeInDatabase('notifications', [
            'id' => $notification->id,
            'disease_model_id' => $notification->disease_model_id,
            'user_id' => $notification->user_id,
            'short_message' => $notification->short_message,
            'full_message' => $notification->full_message,
            'is_viewed' => $notification->is_viewed,
            'is_read' => $notification->is_read,
            'is_valid' => $notification->is_valid,
        ]);

        $notification->delete();

        $this->notSeeInDatabase('notifications', [
            'id' => $notification->id,
            'disease_model_id' => $notification->disease_model_id,
            'user_id' => $notification->user_id,
            'short_message' => $notification->short_message,
            'full_message' => $notification->full_message,
            'is_viewed' => $notification->is_viewed,
            'is_read' => $notification->is_read,
            'is_valid' => $notification->is_valid,
        ]);
    }
}
