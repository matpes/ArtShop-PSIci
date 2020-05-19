<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller
{
    //use AuthenticatesUsers;

    /* Author: Samardžija Sanja 17/0372
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Ovaj kontroler pravi autentifikaciju za jednog korisnika (ukoliko su kredencijali koje je uneo  |
    | u redu) i preusmerava ga na profil.Autentifikacija je globalno dostupna, u svakom trenutnku     |
    | može da se proveri da li postoji trenutno registrovan korisnik i da se dohvati (njegov model).  |
    |
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* Author: Samardžija Sanja 17/0372
    *
     *      Konstruktor kontrolera koji zabranjuje da bilo kojoj
     *      funkciji ovog kontrolera pristupi neko ko nema status gosta.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /* Author: Samardžija Sanja 17/0372
    *
     *      Funkcija koja prikazuje login stranicu
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /*  Author: Samardžija Sanja 17/0372
    *
    *    Funkcija koja prijavljuje korisnika na sistem ukoliko
     *   je uneo ispravne kredencijale. (authenticatesUsers)
     *  @return \Illuminate\View\View
    */
    public function login(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');

        // proveri da li postoji user
        $user = DB::table('users')->where('username', '=', $request->username)->first();
//        dd($user);
        if (is_null($user)) {
            return redirect('login')
                ->with('success',"Ne postoji korisnik sa unetim korisničkim imenom!");
        } else {
            if (Auth::attempt($credentials)) {
                return redirect()
                    ->route('profile.info', ['id'=>$user->id])
                    ->with('success',"Uspešno ste ulogovani!");
            } else{
                return redirect('login')
                    ->with('success',"Nemate pristup ovoj stranici!");
            }
        }
    }

    /*  Author: Samardžija Sanja 17/0372
     *   Funkcija za odjavu sa sistema
     * @return \Illuminate\View\View
     */
    public function logout() {
//        dd($this);
        Session::flush();
        Auth::logout();
        return redirect('layouts.base')->with('success','Uspešno ste se izlogovali!');
    }
}
