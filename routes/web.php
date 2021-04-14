<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('product');
});

Route::get('/bn/', function () {
    App::setLocale('bn');
    return redirect('product');
});

Auth::routes();

Route::resource('product','ProductController');
Route::resource('category','CategoryController');

Route::get('/home', 'HomeController@index')->name('home');
