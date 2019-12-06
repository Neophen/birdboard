<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project)
    {
         $user = User::whereEmail(request('email'))->first();

         $project->invite($user);
    }
}
