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

    protected $user;
    protected $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->hasRole(['title'=>'User', 'user_id'=>User::factory()])->create();
        $this->manager = User::factory()->hasRole(['title'=> 'Manager', 'user_id' => User::factory()])->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_manager_role()
    {
        $response = $this->actingAs($this->manager)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_user_role()
    {
        $response = $this->actingAs($this->user)->get('/feedback');
        $response->assertStatus(200);
    }

    public function test_user_can_not_access_to_dashboard()
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        $response->assertStatus(302);
    }

    public function test_manager_can_not_access_to_feedback()
    {
        $response = $this->actingAs($this->manager)->get('/feedback');
        $response->assertStatus(302);
    }
}
