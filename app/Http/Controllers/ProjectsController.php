<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use \App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    public function store()
    {
        Project::create(request()->validate(['title' => 'required|max:255', 'description' => 'required']));
        return redirect(route('projects.index'));
    }

    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project
        ]);
    }
}
