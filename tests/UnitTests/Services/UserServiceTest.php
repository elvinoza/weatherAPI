<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\UserService;
use App\Models\User;

class UserServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $createdUserList;
    protected $userService;
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->userService = new UserService(new User());
        $this->createdUserList = [];
    }

    /**
     * Create user test.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = (object) array(
            'name' => 'name',
            'email' => 'email@example.com',
            'password' => 'password123'
        );

        $user = $this->userService->createUser($user);

        array_push($this->createdUserList, $user->id);

        $this->seeInDatabase('users', ['id' => $user->id, 'name' => $user->name, 'email' => $user->email]);
    }

    /**
     * Get user test.
     *
     * @return void
     */
    public function testGetUser()
    {
        $userFromMethod = $this->userService->getUser($this->user->id);

        $this->assertEquals($userFromMethod->id, $this->user->id);
        $this->assertEquals($userFromMethod->name, $this->user->name);
        $this->assertEquals($userFromMethod->email, $this->user->email);
    }

    /**
     * Update user data test.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = $this->user;

        $user->name = "changed";
        $user->email = "new@new.com";

        $userFromMethod = $this->userService->update($user->id, $user);

        $this->assertEquals($userFromMethod->id, $user->id);
        $this->assertEquals($userFromMethod->name, "changed");
        $this->assertEquals($userFromMethod->email, "new@new.com");
    }

    public function tearDown()
    {
        foreach ($this->createdUserList as $user) {
            User::find($user)->delete();
        }

        $this->user->delete();

        parent::tearDown();
    }
}
