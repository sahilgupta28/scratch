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

Route::get('/', function () {
    $blogs = App\Blog::latest()->get();
    return view('welcome',compact('blogs'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/blogs','BlogsController');
