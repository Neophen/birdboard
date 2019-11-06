<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function path() {
        // return route('projects.show', $this);
        return "/projects/{$this->id}";
    }
}
