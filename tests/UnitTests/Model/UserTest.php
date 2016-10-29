<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Create User test.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory(User::class)->create();

        $this->seeInDatabase('users', ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password]);

        $user->delete();
    }

    /**
     * Delete User test.
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $user = factory(User::class)->create();

        $this->seeInDatabase('users', ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password]);

        $user->delete();

        $this->notSeeInDatabase('users', ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password]);
    }
}
