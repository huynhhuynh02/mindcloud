<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/your-work', [App\Http\Controllers\HomeController::class, 'workspace'])->name('workspace');
    Route::get('/projects/{key}/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/projects/{key}/tasks/add', [App\Http\Controllers\TaskController::class, 'create'])->name('task-created');
    Route::get('/projects/{key}/tasks/list', [App\Http\Controllers\TaskController::class, 'index'])->name('task-lists');
    Route::get('/projects/{key}/tasks/{task_id}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('task-edit');
    Route::get('/projects/{key}/tasks/{task_id}', [App\Http\Controllers\TaskController::class, 'show'])->name('task-show');
    Route::resource('tasks', App\Http\Controllers\TaskController::class)->only([
        'update', 'store'
    ]);
    Route::resource('organization-settings', App\Http\Controllers\OrganizationController::class);
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    
});