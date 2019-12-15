<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => 'can:admin-panel'], function() {

        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('users', 'UsersController');
        Route::post('/users/{user}/switch', 'UsersController@switch')->name('users.switch');

        Route::get('/projects', 'ProjectsController@index')->name('projects.index');
        Route::get('/projects/create', 'ProjectsController@create')->name('projects.create');
        Route::post('/projects/', 'ProjectsController@store')->name('projects.store');
        Route::post('/projects/{project}/switch', 'ProjectsController@switch')->name('projects.switch');
        Route::get('/projects/{project}/edit', 'ProjectsController@edit')->name('projects.edit');
        Route::put('/projects/{project}', 'ProjectsController@update')->name('projects.update');

        Route::get('/positions', 'PositionsController@index')->name('positions.index');
        Route::get('/positions/create', 'PositionsController@create')->name('positions.create');
        Route::post('/positions/', 'PositionsController@store')->name('positions.store');
        Route::post('/positions/{position}/switch', 'PositionsController@switch')->name('positions.switch');
        Route::get('/positions/{position}/edit', 'PositionsController@edit')->name('positions.edit');
        Route::put('/positions/{position}', 'PositionsController@update')->name('positions.update');

        Route::get('/reports', 'ReportsController@index')->name('reports.index');
        Route::get('/reports/projects', 'ReportsController@projects')->name('reports.projects');
        Route::get('/reports/positions', 'ReportsController@positions')->name('reports.positions');
        Route::get('/reports/users', 'ReportsController@users')->name('reports.users');
});

Route::group([
   'prefix' => 'log',
   'as' => 'log.',
   'middleware' => 'auth'
], function() {
        Route::get('/', 'LogsController@index')->name('home');
        Route::get('/{userId}', 'LogsController@show')->name('show');
        Route::get('/{user}/create', 'LogsController@create')->name('create');
        Route::post('/{user}', 'LogsController@store')->name('store');
        Route::get('/{user}/edit/{log}', 'LogsController@edit')->name('edit');
        Route::put('/{user}/{log}', 'LogsController@update')->name('update');
        Route::delete('/{userId}/{log}', 'LogsController@destroy')->name('destroy');
});