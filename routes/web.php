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

Route::resource('invites', App\Http\Controllers\InviteController::class)->only([
    'index', 'store',
]);
Route::post('/invites-user', [App\Http\Controllers\InviteController::class, 'process'])->name('invite-process');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('projects/{key}')->group(function () {
        Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('tasks/add', [App\Http\Controllers\TaskController::class, 'create'])->name('task-created');
        Route::get('tasks/list', [App\Http\Controllers\TaskController::class, 'index'])->name('task-lists');
        Route::get('tasks/{task_id}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('task-edit');
        Route::get('tasks/{task_id}', [App\Http\Controllers\TaskController::class, 'show'])->name('task-show');
        Route::get('board', [App\Http\Controllers\ProjectController::class, 'board'])->name('project-board');
        Route::get('gantt-api', [App\Http\Controllers\ProjectController::class, 'ganttApi'])->name('gantt-api');
        Route::get('gantt-chart', [App\Http\Controllers\ProjectController::class, 'ganttChart'])->name('gantt-chart');
        Route::get('wiki', [App\Http\Controllers\WikiController::class, 'index'])->name('project-page');
        Route::get('files-manager', [App\Http\Controllers\FileController::class, 'index'])->name('files-manager');
        Route::get('wiki/new', [App\Http\Controllers\WikiController::class, 'create'])->name('project-page-new');
        Route::get('wiki/{page_id}/show', [App\Http\Controllers\WikiController::class, 'show'])->name('page-show');
        Route::get('wiki/{page_id}/edit', [App\Http\Controllers\WikiController::class, 'edit'])->name('page-edit');
    });
    Route::get('/your-work', [App\Http\Controllers\HomeController::class, 'workspace'])->name('workspace');
   
    Route::resource('tasks', App\Http\Controllers\TaskController::class)->only([
        'update', 'store', 'destroy'
    ]);
    Route::resource('wikis', App\Http\Controllers\WikiController::class)->only(
        ['store', 'destroy', 'update']
    );
    Route::post('/attachment', [App\Http\Controllers\TaskFileController::class, 'store'])->name('attachment-task');
    Route::resource('organization-settings', App\Http\Controllers\OrganizationController::class);
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    
});