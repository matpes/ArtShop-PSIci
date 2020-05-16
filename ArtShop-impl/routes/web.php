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

/******************************** MATIJA ****************************************/
Route::get('/', function () {
    return view('layouts.app');
});

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
/********************************** END MATIJA ********************************/

/***************************** SANJA ***************************/
Route::get('/home','HomeController@index')->name('home');

Route::get('/wellcome','HomeController@welcome')->name('welcome');

/*GuestMiddleware group*/
Route::group(['middleware' => 'GuestMiddleware'], function()
{
    //SANJA
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('post-login', 'Auth\LoginController@login')->name('postLogin');
    Route::post('post-register', 'Auth\RegisterController@register')->name('postRegister');
    Route::get('/password/request', 'Auth\ForgotPasswordController@index')->name('password.request');
    Route::post('/password/email', 'Auth\ForgotPasswordController@forgotPassword')->name('password.email');
    //END SANJA

    //MATIJA
    Route::resource('/korpa', 'spKorpa');
    //END MATIJA
});


Route::get('/profileInfo', ['uses' => 'UserController@profileInfo',
    'as' => '/profileInfo', 'middleware', ['UserMiddleware']])->name('profileInfo');

/*UserMiddleware group*/
Route::group(['middleware' => 'UserMiddleware'], function()
{
    //SANJA
//    Route::get('/profile/korisnik_info', 'UserController@profileInfo')->name('profile.user_info');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/password/reset', 'Auth\ResetPasswordController@resetPassword')->name('postPassword.reset');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    //END SANJA
});
/************************ END SANJA ************************/
