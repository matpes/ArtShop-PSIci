 <?php

use Illuminate\Support\Facades\Route;
use App\Picture;
use App\Tema;
use App\Stil;
use \App\Http\Controllers\spKupac;
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
});


Route::get('/insertPics', function(){
    \App\Picture::pocetna();
});


Route::get('/putanja', function (){

    Picture::displayAll();

});



Route::get('/forma', 'spKupac@formaZaPodatke');


Route::get('/insertIntoTable', 'spKupac@pocetnaBaza');


Route::resource('/kupac_forma', 'spKupac');



Route::resource('/pretraga', 'spPretraga');


Route::resource('/slika', 'spSlika');




/*
 Route::get('/contact', function (){
     return "Hi I am contact";
 });

 Route::get('/about', function (){
     return "Hi, this is about";
 });


 Route::get('/post/{id}/{name}', function ($id, $name) {

     return "this is post number ". $id. " ". $name;




 });


 Route::get('admin/posts/example', array( 'as' => 'admin.home' , function () {

    $url = route('admin.home');


    return  "this url is ". $url;

 }));


 //Route::get('/post/{id}', 'PostController@index');


 Route::resource('posts', 'PostController');


 Route::get('/contact', 'PostController@contact');

 Route::get('/post/{id}', 'PostController@post_some');*/

