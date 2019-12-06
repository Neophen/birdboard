<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $john = $this->signIn();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', ['email' => $john->email]);

        $this->assertTrue($project->members->contains($john));
    }

    /** @test */
    public function invited_users_can_update_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = factory(User::class)->create());

        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Some task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
