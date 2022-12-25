<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SetUserRoleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_role()
    {
        $user = User::factory()->create();
        $user->setUserRole('User');
        $this->assertDatabaseHas('roles', ['title' => 'User', 'user_id' => $user->id]);
    }
}
