<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test **/
    public function guests_cannot_manage_projects()
    {
        $project = ProjectFactory::create();

        $this->get($project->path())->assertRedirect('login');
        $this->patch($project->path())->assertRedirect('login');
        $this->delete($project->path())->assertRedirect('login');
        $this->get(route('projects.edit', $project))->assertRedirect('login');
        $this->get(route('projects.index'))->assertRedirect('login');
        $this->get(route('projects.create'))->assertRedirect('login');
        $this->post(route('projects.index'), $project->toArray())->assertRedirect('login');
    }

    /** @test **/
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get(route('projects.create'))->assertStatus(200);

        $attributes = [
            'title' => $this->faker()->sentence(),
            'description' => $this->faker()->sentence(),
            'notes' => $this->faker()->sentence(),
        ];

        $response = $this->post(route('projects.store'), $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test **/
    public function a_user_can_delete_a_project()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test **/
    public function a_user_can_update_a_project()
    {
        $project = ProjectFactory::create();
        $attributes = [
            'title' => 'Roses',
            'notes' => 'are',
            'description' => 'red',
        ];

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes)
            ->assertRedirect($project->path());

        $this->get(route('projects.edit', $project))
            ->assertOk()
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test **/
    public function a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();
        $attributes = [
            'notes' => 'CHANGED',
        ];

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes)
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['notes']);
    }

    /** @test **/
    public function a_user_can_view_their_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test **/
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test **/
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->patch($project->path())->assertStatus(403);
    }

    /** @test **/
    public function an_authenticated_user_cannot_delete_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->delete($project->path())->assertStatus(403);
    }

    /** @test **/
    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->post(route('projects.index'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test **/
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post(route('projects.index'), $attributes)->assertSessionHasErrors('description');
    }
}
