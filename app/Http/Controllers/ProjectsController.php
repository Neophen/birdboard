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
        $projects = auth()->user()->projects;
        return view('projects.index', ['projects' => $projects]);
    }

    public function store()
    {
        $project = auth()->user()->projects()->create(request()->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'notes' => 'min:3'
        ]));

        return redirect($project->path());
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', [
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

        $project->update(request()->validate([
            // 'title' => 'sometimes|required|max:255',
            // 'description' => 'sometimes|required',
            'notes' => 'min:3'
        ]));

        return redirect($project->path());
    }
}
