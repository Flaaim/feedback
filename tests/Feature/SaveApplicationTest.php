<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class SaveApplicationTest extends TestCase
{

    use RefreshDatabase;

    public function test_what_user_can_create_application()
    {
        $user = User::factory()->hasRole(['title'=>'User', 'user_id'=>User::factory()])->create();
        $response = $this->actingAs($user)->post('/feedback', ['theme' => 'One', 'message' => 'Hello', 'file' => 'file.xml']);
        
        $response->assertStatus(302);
        $this->assertDatabaseHas('applications', ['theme' => 'One', 'message' => 'Hello', 'file' => 'file.xml']);
    }

}
