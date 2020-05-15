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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//SANJA

Route::group(['middleware' => 'GuestMiddleware'], function()
{
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('post-login', 'Auth\LoginController@login')->name('postLogin');
    Route::post('post-register', 'Auth\RegisterController@register')->name('postRegister');
    Route::get('/password/request', 'Auth\ForgotPasswordController@index')->name('password.request');
    Route::post('/password/email', 'Auth\ForgotPasswordController@forgotPassword')->name('password.email');
});

Route::get('/profile/user_info', 'UserController@profileInfo')->name('user_info');

Route::group(['middleware' => 'UserMiddleware'], function()
{
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/password/reset', 'Auth\ResetPasswordController@resetPassword')->name('postPassword.reset');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
});
//END SANJA
