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

Route::get('/welcome', function () {
    broadcast(new \App\Events\PublicEvent);
    return view('welcome');
});

Route::get('/', function () {
    return redirect('/thread');
});

Route::get('/thread', 'ThreadController@index');
Route::post('/thread', 'ThreadController@add');
Route::get('/thread/{id}', 'ThreadController@detail');
Route::post('/thread/{id}', 'CommentController@add');
Route::get('/thread/delete/{id}', 'ThreadController@delete');

Route::post('/search', 'ThreadController@search');

Route::get('/create', 'ThreadController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
