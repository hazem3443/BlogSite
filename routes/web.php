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

/*
Route::get('/hello', function () {
    return '<h1>welcome</h1>';
});

Route::get('/users/{id}/{name}', function ($id,$name) {
    return '<h1>this is user name: '.$name.' with an id of: '.$id.' end</h1>';
});

*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

//will create all of the 7-routes for our PostsController
Route::resource('posts','PostsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
