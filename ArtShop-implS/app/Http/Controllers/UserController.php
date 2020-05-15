<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;

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

    public function remove($id)
    {
        $user = User::where('id','=',$id);
        $user = $user->first();
        DB::beginTransaction();
        DB::table('komentars')->where('user_id', '=', $id)->delete();
        DB::table('korpas')->where('user_id', '=', $id)->delete();
        DB::commit();
        Session::flush();
        Auth::logout();
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->route('home');

    }

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja dohvata podatke za trenutno ulogovanog korisnika
     *
     * @param
     * @return View
     */

    public function userProfile()
    {
        $user = Auth::user();
        //dovlacenje popularnih slika u $popular
        $popular = null;
        if(Auth::check()){
            $popular = DB::table('pictures')
                ->orderBy('ocena', 'desc')
                ->select('path')
                ->limit(5)
                ->get();
        }
        return response()->view('profile.user_info', $popular);
    }

    /**
     * Author: Samardžija Sanja 17/0372
     * Funkcija koja vodi na formu sa informacijama o korisniku
     *
     * @param
     * @return View
     */

    public function profileInfo(){
        $user = Auth::user();
        dd($user);
        $slikar = DB::table('slikars')
            ->where('korisnik_id', '=', $user->id)
            ->first();
        $brOcena = 0;
        if(!is_null($slikar)){
            $brOcena = DB::table('pictures')
                ->join('za_ocenus','za_ocenus.picture_id','=','pictures.id')
                ->where('pictures.korisnik_id','=', $slikar->korisnik_id)
                ->count();
        }
        return view('profile.user_info',['user'=>$user, 'slikar'=>$slikar, 'brOcena'=>$brOcena]);
    }
}

