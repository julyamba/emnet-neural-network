<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::redirect('/', '/project');

Route::resource('project',ProjectController::class);
