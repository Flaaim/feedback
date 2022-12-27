<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class RoleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_manager_role()
    {
        $user = User::factory()->hasRole(['title'=> 'Manager', 'user_id' => User::factory()])->create();
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_user_role()
    {
        $user = User::factory()->hasRole(['title'=>'User', 'user_id'=>User::factory()])->create();
        $response = $this->actingAs($user)->get('/feedback');

        $response->assertStatus(200);
    }
}
