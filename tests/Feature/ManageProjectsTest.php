<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test **/
    public function guests_cannot_manage_projects()
    {
        $project = factory('App\Project')->create();

        $this->get($project->path())->assertRedirect('login');
        $this->get(route('projects.index'))->assertRedirect('login');
        $this->get(route('projects.create'))->assertRedirect('login');
        $this->post(route('projects.index'), $project->toArray())->assertRedirect('login');
    }

    /** @test **/
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get(route('projects.create'))->assertStatus(200);

        $attributes = [
            'title' => $this->faker()->sentence(),
            'description' => $this->faker()->paragraph(),
        ];

        $this->post(route('projects.store'), $attributes)->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects.index'))->assertSee($attributes['title']);
    }

    /** @test **/
    public function a_user_can_view_their_project()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }

    /** @test **/
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test **/
    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post(route('projects.index'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test **/
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post(route('projects.index'), $attributes)->assertSessionHasErrors('description');
    }
}
