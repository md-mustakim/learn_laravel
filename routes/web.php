<?php

use App\Http\Controllers\UserController;
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
Route::resource('employee','EmployeeController');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('user')->group(function (){
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::get('show/{user}', [UserController::class, 'show'])->name('user.show');

    Route::get('login', [UserController::class, 'showLoginPage'])->name('user.login');
    Route::post('login', [UserController::class, 'userLogin'])->name('user.login');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::delete('delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});
