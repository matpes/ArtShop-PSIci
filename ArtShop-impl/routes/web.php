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
/*Route::get('/', function () {
    return view('layouts.app');
});*/

Route::resource('/kupac_forma', 'spKupac', ['middleware' => ['UserMiddleware', 'KupacMiddleware']]);


Route::resource('/zaOcenu', 'spZaOcenu', ['middleware' => ['UserMiddleware', 'KupacMiddleware']]);

Route::resource('picture', 'spPicture', ['middleware' => ['UserMiddleware']]);
Route::get('picture/{id}', 'spPicture@show');

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
    Route::get('/', 'GuestController@popularPictures')->name('home');
    Route::get('/welcome', 'GuestController@popularPictures')->name('welcome');
//    Route::get('/home', 'GuestController@index')->name('home');
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('post-login', 'Auth\LoginController@login')->name('postLogin');
    Route::post('post-register', 'Auth\RegisterController@register')->name('postRegister');
    Route::get('/password/email', 'Auth\ForgotPasswordController@index')->name('password.request');
    Route::post('/password/email', 'Auth\ForgotPasswordController@forgotPassword')->name('password.email');


});


//VLADANA
Route::group(['middleware' => 'SlikarMiddleware'], function() {
    Route::post('/slika/save', 'spSlika@postSlika')->name('slika.save');
    Route::post('/slika/unsave', 'spSlika@unsaveSlika')->name('slika.unsave');
});
//END VLADANA






Route::group(['middleware' => 'KupacMiddleware'], function(){

    Route::get('picture/{id}/edit', 'spPicture@edit');

    Route::get('/profile/user/{id}', 'UserController@userProfile')->name('profile.user');

    //MATIJA
    Route::resource('/korpa', 'spKorpa');
    //END MATIJA
    Route::post('subscribe', 'spKupac@subscribe');
});

Route::group(['middleware' => 'UserMiddleware'], function()
{
    Route::get('/profile/info/{id}', 'UserController@profileInfo')->name('profile.info');
    Route::get('/profile/user_new/{id}', 'UserController@popularPictures')->name('profile.user_new');
    Route::get('/profile/user_slikar/{id}', 'UserController@indexSlikarProfile')->name('profile.user_slikar');
    Route::post('/profile/user_slikar', 'UserController@ajaxSlikarProfile');
    Route::get('/profile/picture/{id}', 'UserController@indexProfilePicture')->name('profile.picture');
    Route::post('/profile/picture/{id}', 'UserController@changeProfilePicture')->name('postProfile.picture');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    //Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@index')->name('password.reset');
    Route::post('/password/reset/{token}', 'Auth\ResetPasswordController@resetPassword')->name('postPassword.reset');
    Route::get('/password/reset', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/removeAccount/{id}', 'UserController@removeAccount')->name('removeAccount');



    //ANA
   /* Route::get('comments', 'KomentariController@showAllComments');
    Route::get('commentsOfPictureId/{id}', 'KomentariController@showAllCommentsOfPicture');
    Route::post('postComment', 'KomentariController@store')->name('comment.post');
    Route::post('comment/delete/', 'KomentariController@delete')->name('comment.delete');
    Route::get('comment/middle', 'KomentariController@medjuFunkcija');
    Route::post('prijave', 'KomentariController@prijava')->name('comment.report');
    Route::get('prijave/show', 'KomentariController@prikaziPrijave');*/
    //END ANA
});
//END SANJA

//ANA

/*Route::get('commentsOfPictureId/Admin/{id}', 'AdminController@showAllCommentsOfPicture');
Route::get('prijave/Admin/delete', 'AdminController@delete');
Route::get('prijavljenKomentar', 'AdminController@komentarSlika');
Route::get('nalozi/show', 'AdminController@sviKorisnickiNalozi');
Route::get('profile/info/fromAdmin/{id}', 'AdminController@profileInfo');
Route::get('nalozi/block/{id}', 'AdminController@blokirajNalog');
Route::get('nalozi/unblock/{id}', 'AdminController@odblokirajNalog');
Route::get('admin', 'AdminController@index');*/

//moje stare rute

Route::get('comments', 'KomentariController@showAllComments');
Route::get('commentsOfPictureId/{id}', 'KomentariController@showAllCommentsOfPicture');
Route::get('commentsOfPictureId/Admin/{id}', 'AdminController@showAllCommentsOfPicture');
Route::get('postComment', 'KomentariController@store');
Route::get('comment/delete', 'KomentariController@delete');
Route::get('comment/middle', 'KomentariController@medjuFunkcija');
Route::get('prijave', 'KomentariController@prijava');
Route::get('prijave/show', 'KomentariController@prikaziPrijave');
Route::get('prijave/Admin/delete', 'AdminController@delete');
Route::get('prijavljenKomentar', 'AdminController@komentarSlika');
Route::get('nalozi/show', 'AdminController@sviKorisnickiNalozi');
Route::get('profile/info/fromAdmin/{id}', 'AdminController@profileInfo');
Route::get('nalozi/block/{id}', 'AdminController@blokirajNalog');
Route::get('nalozi/block', 'AdminController@blokirajNalog1');
Route::get('nalozi/unblock/{id}', 'AdminController@odblokirajNalog');
Route::get('admin', 'AdminController@index');
Route::get('brisanjePrijave', 'AdminController@brisanjePrijave');


//END ANA

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
