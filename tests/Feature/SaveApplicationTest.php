<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationCreateNotification;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Application;
use App\Events\ApplicationCreate;

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

    public function test_what_user_can_create_application_once_a_day()
    {
        $user = User::factory()->hasRole(['title'=>'User', 'user_id'=>User::factory()])->create();
        $response = $this->actingAs($user)->post('/feedback', ['theme' => 'One', 'message' => 'Hello', 'file' => 'file.xml']);
        $response = $this->actingAs($user)->post('/feedback', ['theme' => 'One', 'message' => 'Hello', 'file' => 'file.xml']);
        $response->assertStatus(302);
    }

    public function test_send_notification_to_manager_after_create_application()
    {   
        Notification::fake();
        $manager = User::factory()->hasRole(['title' => 'Manager', 'user_id' => User::factory()])->create();
        $application = Application::factory()->create();
        event(new ApplicationCreate($application));
        Notification::assertSentTo([$manager], ApplicationCreateNotification::class);
    }

    public function test_send_notification_to_user_after_create_application()
    {
        Notification::fake();
        $user = User::factory()->hasRole(['title' => 'User', 'user_id' => User::factory()])->create();
        $application = Application::factory()->create();
        event(new ApplicationCreate($application));
        Notification::assertNotSentTo([$user], ApplicationCreateNotification::class);
    }

}
