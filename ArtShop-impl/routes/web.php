<?php


use App\Events\Auction;
use App\Mail\pictureLost;
use App\Mail\pictureWon;
use App\User;
use App\ZaOcenu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
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
Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('/kupac_forma', 'spKupac', ['middleware' => ['UserMiddleware', 'KupacMiddleware']]);


Route::resource('/zaOcenu', 'spZaOcenu', ['middleware' => ['UserMiddleware', 'KupacMiddleware']]);

Route::resource('picture', 'spPicture');

Auth::routes();

/*Route::get('/insertPics', function(){
    Picture::pocetna();
});


Route::get('/forma', 'spKupac@formaZaPodatke');


Route::get('/insertIntoTable', 'spKupac@pocetnaBaza');*/




//  END MATIJA

//SANJA

Route::group(['middleware' => 'GuestMiddleware'], function()
{
    Route::get('/welcome', 'HomeController@welcome')->name('welcome');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('post-login', 'Auth\LoginController@login')->name('postLogin');
    Route::post('post-register', 'Auth\RegisterController@register')->name('postRegister');
    Route::get('/password/request', 'Auth\ForgotPasswordController@index')->name('password.request');
    Route::post('/password/email', 'Auth\ForgotPasswordController@forgotPassword')->name('password.email');


});


Route::group(['middleware' => 'UserMiddleware'], function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profileInfo', 'UserController@profileInfo')->name('userInfo');
    Route::get('/profile/{id}', 'UserController@userProfile')->name('userProfile');
    Route::get('/changeProfilePicture', 'UserController@indexProfilePicture')->name('profilePicture');
    Route::post('/changeProfilePicture', 'UserController@changeProfilePicture')->name('postProfilePicture');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/password/reset/{token}', 'Auth\ResetPasswordController@resetPassword')->name('postPassword.reset');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/removeAccount/{id}', 'UserController@removeAccount')->name('removeAccount');
    //MATIJA
    Route::resource('/korpa', 'spKorpa');
    Route::post('subscribe', 'spKupac@subscribe');
    //END MATIJA
});
//END SANJA



//ROUTA ZA TESTIRANJE PROIZVOLJNIH DELOVA KODA
Route::get('test', function (){

    $picture = Picture::onlyTrashed()->find(12);
    if(Carbon::parse($picture->danIstekaAukcije)->diffInMinutes(Carbon::now(), false)>0){
        //ZATVARANJE AUKCIJE
        $pobednik = null;
        $gubitnici = null;
        $picture->krajAukcije($pobednik, $gubitnici);
        //dd($pobednik);
        dd($gubitnici);

        /*foreach ($pobednik as $pob){
            Mail::to(User::find($pob->user_id)->email)->send(new pictureWon($picture));
            $zaOcenu = new ZaOcenu;
            $zaOcenu->picture_id = $picture->id;
            $zaOcenu->user_id = $pob->user_id;
            $zaOcenu->ocena = 0;
            $zaOcenu->save();
        }

        foreach ($gubitnici as $gub){
            Mail::to(User::find($gub->user_id)->email)->send(new pictureLost($picture));
        }*/



        //$picture->delete();


    }else{
        event(new Auction($picture));
        sleep(60);
    }
});
