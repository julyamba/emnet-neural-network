<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $filters = request()->only([
            'name','orderBy','owner'
        ]);

        return Inertia::render('Project/Index',
        [
            'filters' => $filters,
            'projects' => Project::with('owner')
                ->filter($filters)
                ->paginate(15)
                ->withQueryString()
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
