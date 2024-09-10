<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Project/Index',
        [
            'projects' => Project::with('owner')->latest()->paginate(15)
        ]);
    }

    public function show(Project $project) 
    {
        return Inertia::render('Project/Show',
        [
            'project' => $project
        ]);
    }
}
