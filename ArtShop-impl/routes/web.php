<?php


use App\ZaOcenu;
use Illuminate\Support\Facades\Route;
use App\Picture;
use \App\Http\Controllers\spKupac;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

  /*******************************************************************************/
 /*  !!!!!!!!!!SVAKO U SVOJOJ SEKCIJI NEKA PISE DA SE NE POGUBIMO!!!!!          */
/*******************************************************************************/

//VLADANA

Route::resource('/slika', 'spSlika', ['middleware' => ['UserMiddleware', 'SlikarMiddleware']]);

Route::resource('/pretraga', 'spPretraga');

//END VLADANA

// MATIJA
/*Route::get('/', function () {
    return view('layouts.app');
});*/

Auth::routes();

Route::get('/insertPics', function(){
    Picture::pocetna();
});


Route::get('/forma', 'spKupac@formaZaPodatke');


Route::get('/insertIntoTable', 'spKupac@pocetnaBaza');


Route::resource('/kupac_forma', 'spKupac');


Route::resource('/zaOcenu', 'spZaOcenu');

Route::resource('picture', 'spPicture');


 Route::get('proba', function (){


     dd(ZaOcenu::zaOcenu(1));
 });
//  END MATIJA

//SANJA

Route::group(['middleware' => 'GuestMiddleware'], function()
{
    Route::get('/', 'GuestController@popularPictures')->name('home');
//    Route::get('/welcome', 'GuestController@popularPictures')->name('welcome');
//    Route::get('/home', 'GuestController@index')->name('home');
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('post-login', 'Auth\LoginController@login')->name('postLogin');
    Route::post('post-register', 'Auth\RegisterController@register')->name('postRegister');
    Route::get('/password/request', 'Auth\ForgotPasswordController@index')->name('password.request');
    Route::post('/password/email', 'Auth\ForgotPasswordController@forgotPassword')->name('password.email');

    //MATIJA
    Route::resource('/korpa', 'spKorpa');
    //END MATIJA
});


Route::group(['middleware' => 'UserMiddleware'], function()
{
    Route::get('/profile/info/{id}', 'UserController@profileInfo')->name('profile.info');
    Route::get('/profile/user/{id}', 'UserController@userProfile')->name('profile.user');
    Route::get('/profile/user_new/{id}', 'UserController@popularPictures')->name('profile.user_new');
    Route::get('/changeProfilePicture', 'UserController@indexProfilePicture')->name('profile.picture');
    Route::post('/changeProfilePicture', 'UserController@changeProfilePicture')->name('postProfile.picture');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/password/reset/{token}', 'Auth\ResetPasswordController@resetPassword')->name('postPassword.reset');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/removeAccount/{id}', 'UserController@removeAccount')->name('removeAccount');
});
//END SANJA
