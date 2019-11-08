<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_task_belongs_to_a_project()
    {
        $task = factory(\App\Task::class)->create();

        $this->assertInstanceOf(\App\Project::class, $task->project);
    }

    /** @test **/
    public function it_has_a_path()
    {
        $project = factory('App\Project')->create();

        $task = $project->addTask('Enjoy the journey');

        $this->assertEquals("/projects/{$project->id}/tasks/{$task->id}", $task->path());
    }
}
