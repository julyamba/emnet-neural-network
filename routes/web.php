<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\VideoUploadController;

Route::get('/', function () {
    return Inertia::render('VideoUpload');
});
Route::post('/upload', [VideoUploadController::class, 'uploadChunk']);

// Route::redirect('/', '/project');

Route::resource('project',ProjectController::class);

Route::get('login',[AuthController::class, 'create'])->name('login');
Route::post('login',[AuthController::class, 'store'])->name('login.store');
Route::delete('logout',[AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account',UserAccountController::class)->only(['create', 'store']);