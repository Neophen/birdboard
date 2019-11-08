<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_has_a_path()
    {
        $project = factory('App\Project')->create();

        $this->assertEquals("/projects/{$project->id}", $project->path());
    }

    /** @test **/
    public function has_owner()
    {
        $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }

    /** @test **/
    public function it_can_add_a_task()
    {
        $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();

        $task = $project->addTask('Smile more');

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
