<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Concerns\InteractsWithInput;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\File;


/** UserController - kontroler za standardne funkcionalnosti koje mogu da koriste svi registrovani korisnici.
 *
 * @version 1.0
 */

class UserController extends Controller
{
    /* Author: Samardžija Sanja 17/0372
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    */

    public function __construct()
    {
        $this->middleware('UserMiddleware');
    }

    /**
     * Author: Samardžija Sanja 17/0372
     * Funkcija koja uklanja korisnikov nalog iz baze
     *
     * @param integer $id
     * @return Redirect
     */

    public function removeAccount($id)
    {
        $user = User::where('id','=',$id);
        $user = $user->first();
        DB::beginTransaction();
        DB::table('komentars')->where('user_id', '=', $id)->delete();
        DB::table('korpas')->where('user_id', '=', $id)->delete();
        if($user->isSlikar) {
            DB::table('slikars')->where('user_id', '=', $id)->delete();
       /* } elseif($user->isAdmin){
            DB::table('admins')->where('user_id', '=', $id)->delete();*/
        } else{
            DB::table('kupacs')->where('user_id', '=', $id)->delete();
        }
        DB::commit();
        Session::flush();
        Auth::logout();
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->route('home');
    }

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja dohvata slike slikara koje kupac prati
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfile($id) {
        $user = DB::table('users')
            ->where('id','=',$id)
        ->first();
        $slikari = null;
        $slike = array();
        if(!$user->isSlikar) {
            //dovlacenje slika slikara koji se prate u $slike
            $slikari = DB::table('kupac_slikar')
                ->where('kupac_id', '=', $id)
                ->select('slikar_id')
                ->get();
            foreach ($slikari as $s) {
                $sl = DB::table('pictures')
                    ->where('pictures.user_id', '=', $s);

                array_push($slike, $sl);
            }
        } else {
            return redirect()->route('profile.user_new',['id'=>$id]);
        }
        return response()->view('profile.user', ['user'=>$user, 'slike'=>$slike]);
    }

    /**
     * Author: Samardžija Sanja 17/0372
     * Funkcija koja vodi na formu sa informacijama o korisniku
     *
     * @param
     * @return view

     */
    public function profileInfo(){
        $user = Auth::user();
        $slikar = DB::table('slikars')
            ->where('user_id', '=', $user->id)
            ->first();
        $brOcena = 0;
        if(!is_null($slikar)){
            $brOcena = DB::table('pictures')
                ->join('za_ocenus','za_ocenus.picture_id','=','pictures.id')
                ->where('pictures.user_id','=', $slikar->user_id)
                ->count();
        }
        return response()->view('profile.info',['user'=>$user, 'slikar'=>$slikar, 'brOcena'=>$brOcena]);
    }


    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja dohvata 5 najnovijih slika
     *
     * @param
     * @return view
     */
    public function popularPictures()
    {
        $user = Auth::user();
//        dd($user);
        //dovlacenje najnovijih slika u $popular
        $novo = array();

        $novo = DB::table('pictures')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->view('profile.user_new', ['novo'=>$novo, 'user'=>$user]);
    }

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja vraća formu za promenu profilne slike
     *
     * @param
     * @return view
     */
    public function indexProfilePicture(){
        return response()->view('profile.picture');
    }

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja menja profilnu sliku
     *
     * @param
     * @return view
     */
    public function changeProfilePicture(Request $request){

//        dd($request->path);
        $rules = [
            'path' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
        $messages = [
            'path.required'=> 'Morate prvo izabrati fajl!',
            'path.image'=>' Ovo polje je obavezno',
            'path.mimes' => 'Format slike nije podržan! Podržani formati su: jpeg,png,jpg,svg.',
            'path.max'=>'Fajl ne sme biti veći od :max B',
        ];
//        dd($data);
        $validate = Validator::make($request->all(), $rules, $messages);
        if($validate->fails()){
//            dd("failed");
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

//        dd($request->path);
        $user = Auth::user();
        if(!is_null($user->picture_path)) {
            Storage::delete('images/users/' . $user->picture_path);
        }
//        dd($user);
        $filename = $user->id . '.' . $request->path->getClientOriginalExtension();
//        dd($filename);
//        $path = Storage::putFile('images/users/' . $filename, $request->file('path'));
//        $file = $request->file('path')->storeAs('images\users', $filename);
        $file = $request->file('path')->move('images\users', $filename);
//        dd($file);
        DB::table('users')
            ->where('id', '=', $user->id)
            ->limit(1)
            ->update(['picture_path' => $filename]);

        return redirect()->route('profile.info', [$user->id])
            ->with('success',"Uspešno promenjena profilna slika!");
    }
}

