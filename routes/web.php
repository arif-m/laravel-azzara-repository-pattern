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

Route::get('/', [App\Http\Controllers\LoginController::class, 'login'])->name('home');
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('login', [App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionlogin');

Route::post('logout', [App\Http\Controllers\LoginController::class, 'actionLogout'])->name('logout')->middleware('auth');
Route::get('register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('post.register');

//Auth::routes();

//SYSTEM
Route::resource('backend/user', 'App\Http\Controllers\UserController'); //user
Route::resource('backend/group-user', 'App\Http\Controllers\GroupUserController'); //group user
route::get('/backend/profile', 'App\Http\Controllers\HomeController@profile')->name('backend.profile')->middleware('auth'); //memanggil form user profile 
route::get('/backend/change-password', 'App\Http\Controllers\HomeController@change_password')->name('backend.change_password')->middleware('auth'); //memanggil form change user password

Route::Post('change-password', 'App\Http\Controllers\UserController@changePassword')->name('change-password'); //change password
Route::Post('change-password-by-admin/{id}', array('as' => 'change-password-by-admin', 'uses' => 'App\Http\Controllers\UserController@changePasswordByAdmin')); //change password by admin
Route::Post('backend/change-image', 'App\Http\Controllers\UserController@changeImage'); //change image profile

//upload file
Route::post('upload/fileProfileUpload', 'App\Http\Controllers\UploadController@FileProfileUpload');

//populate data of datatables	
Route::get('datatables/dataGroupUser', 'App\Http\Controllers\DatatablesController@getDataGroupUser');
Route::get('datatables/dataUser', 'App\Http\Controllers\DatatablesController@getDataUser');
