<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        request()->validate([
            'body' => 'required'
        ]);

        if (auth()->user()->isNot($project->owner)) {
            return abort(403);
        }

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        request()->validate([
            'body' => 'required'
        ]);

        if (auth()->user()->isNot($task->project->owner)) {
            return abort(403);
        };

        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed')
        ]);

        return redirect($project->path());
    }
}
