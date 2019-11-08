<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function guest_cannot_add_tasks_to_projects()
    {
        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test **/
    public function only_the_project_owner_can_add_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Not my project'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Not my project']);
    }

    /** @test **/
    public function only_the_project_owner_can_update_a_task()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $task = $project->addTask("Take care of yourself, like of someone who you're responsible for");

        $this->patch($task->path(), ['body' => 'Not my project'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => "Not my project"]);
    }

    /** @test **/
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $this->post($project->path() . '/tasks', ['body' => 'Buy flowers']);

        $this->get($project->path())
            ->assertSee('Buy flowers');
    }

    /** @test **/
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $project = auth()->user()->projects()->create(factory(Project::class)->raw());
        $task = $project->addTask('Stand up straight');

        $this->patch($task->path(), [
            'body' => 'With your shoulders back',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks', ['body' => 'With your shoulders back', 'completed' => true]);
    }

    /** @test **/
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
