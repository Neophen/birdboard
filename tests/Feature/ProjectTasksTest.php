<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

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
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
