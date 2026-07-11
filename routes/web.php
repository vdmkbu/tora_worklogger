<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PositionsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'can:admin-panel',
], function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
    Route::resource('users', UsersController::class);
    Route::post('/users/{user}/switch', [UsersController::class, 'switch'])->name('users.switch');

    Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
    Route::post('/projects/', [ProjectsController::class, 'store'])->name('projects.store');
    Route::post('/projects/{project}/switch', [ProjectsController::class, 'switch'])->name('projects.switch');
    Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectsController::class, 'update'])->name('projects.update');

    Route::get('/positions', [PositionsController::class, 'index'])->name('positions.index');
    Route::get('/positions/create', [PositionsController::class, 'create'])->name('positions.create');
    Route::post('/positions/', [PositionsController::class, 'store'])->name('positions.store');
    Route::post('/positions/{position}/switch', [PositionsController::class, 'switch'])->name('positions.switch');
    Route::get('/positions/{position}/edit', [PositionsController::class, 'edit'])->name('positions.edit');
    Route::put('/positions/{position}', [PositionsController::class, 'update'])->name('positions.update');

    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/reports/projects', [ReportsController::class, 'projects'])->name('reports.projects');
    Route::get('/reports/positions', [ReportsController::class, 'positions'])->name('reports.positions');
    Route::get('/reports/users', [ReportsController::class, 'users'])->name('reports.users');
});

Route::group([
    'prefix' => 'log',
    'as' => 'log.',
    'middleware' => 'auth',
], function () {
    Route::get('/', [LogsController::class, 'index'])->name('home');
    Route::get('/{userId}', [LogsController::class, 'show'])->name('show');
    Route::get('/{user}/create', [LogsController::class, 'create'])->name('create');
    Route::post('/{user}', [LogsController::class, 'store'])->name('store');
    Route::get('/{user}/edit/{log}', [LogsController::class, 'edit'])->name('edit');
    Route::put('/{user}/{log}', [LogsController::class, 'update'])->name('update');
    Route::delete('/{userId}/{log}', [LogsController::class, 'destroy'])->name('destroy');
});
