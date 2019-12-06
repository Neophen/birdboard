<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use \App\Project;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = auth()->user()->availableProjects();
        return view('projects.index', ['projects' => $projects]);
    }

    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateProject());

        return redirect($project->path());
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', [
            'project' => $project
        ]);
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', [
            'project' => $project
        ]);
    }

    public function create()
    {
        if (!auth()->check()) {
            abort(403);
        }
        return view('projects.create');
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateProject());

        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();

        return redirect(route('projects.index'));
    }

    protected function validateProject()
    {
        return request()->validate([
            'title' => 'sometimes|required|max:255',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);
    }
}
