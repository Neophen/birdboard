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
        ]));

        return redirect($project->path());
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }
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
}
