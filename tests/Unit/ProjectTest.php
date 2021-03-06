<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_has_a_path()
    {
        $project = factory(Project::class)->create();

        $this->assertEquals("/projects/{$project->id}", $project->path());
    }

    /** @test **/
    public function has_owner()
    {
        $project = factory(Project::class)->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }

    /** @test **/
    public function it_can_add_a_task()
    {
        $project = factory(Project::class)->create();

        $task = $project->addTask('Smile more');

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }

    // /** @test **/
    // public function it_can_be_deleted()
    // {
    //     $this->withoutExceptionHandling();
    //     $project = ProjectFactory::create();
    //     $project->delete();

    //     $this->assertDatabaseMissing('projects', $project);
    // }

    /** @test */
    public function it_can_invite_a_user()
    {
        $project = factory(Project::class)->create();
        $project->invite($user = factory(User ::class)->create());

        $this->assertTrue($project->members->contains($user));
    }
}
