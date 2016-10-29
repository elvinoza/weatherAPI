<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\UserService;
use App\Models\User;

class UserServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Create user test.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $userService = new UserService(new User());

        $user = (object) array(
            'name' => 'name',
            'email' => 'email@example.com',
            'password' => 'password123'
        );

        $user = $userService->createUser($user);

        $this->seeInDatabase('users', ['id' => $user->id, 'name' => 'name', 'email' => 'email@example.com']);

        $userService->delete($user->id);

    }

    /**
     * Get user test.
     *
     * @return void
     */
    public function testGetUser()
    {
        $userService = new UserService(new User());

        $user = factory(User::class)->create();

        $userFromMethod = $userService->getUser($user->id);

        $this->assertEquals($userFromMethod->id, $user->id);
        $this->assertEquals($userFromMethod->name, $user->name);
        $this->assertEquals($userFromMethod->email, $user->email);

        $userService->delete($user->id);
    }

    /**
     * Update user data test.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $userService = new UserService(new User());

        $user = factory(User::class)->create();

        $user->name = "changed";
        $user->email = "new@new.com";

        $userFromMethod = $userService->update($user->id, $user);

        $this->assertEquals($userFromMethod->id, $user->id);
        $this->assertEquals($userFromMethod->name, "changed");
        $this->assertEquals($userFromMethod->email, "new@new.com");

        $userService->delete($user->id);
    }
}
