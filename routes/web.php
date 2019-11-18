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
});