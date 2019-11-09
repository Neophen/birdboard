<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function guest_cannot_add_tasks_to_projects()
    {
        $project = ProjectFactory::create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test **/
    public function only_the_project_owner_can_add_tasks()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->post($project->path() . '/tasks', ['body' => 'Not my project'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Not my project']);
    }

    /** @test **/
    public function only_the_project_owner_can_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'Not my project'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => "Not my project"]);
    }

    /** @test **/
    public function a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Buy flowers']);

        $this->get($project->path())
            ->assertSee('Buy flowers');
    }

    /** @test **/
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks()->first()->path(), [
            'body' => 'With your shoulders back',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks', ['body' => 'With your shoulders back', 'completed' => true]);
    }

    /** @test **/
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory(Task::class)->raw(['body' => '']);

        $this->actingAs($project->owner)->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
