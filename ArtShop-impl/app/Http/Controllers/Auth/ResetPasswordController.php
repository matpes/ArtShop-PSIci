<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
     * Author: Samardžija Sanja 17/0372
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Kontroler zadužen za resetovanje lozinki
    |
    */

    use ResetsPasswords;

    /*
     *  Author: Samardžija Sanja 17/0372
     *      Konstruktor kontrolera koji zabranjuje da bilo kojoj
     *      funkciji ovog kontrolera pristupi neko ko nema status korisnika.
     * @return void
     */
    public function __construct()
    {
         $this->middleware('user');
    }

    /*
     *  Author: Samardžija Sanja 17/0372
     *      Prikazuje stranicu za resetovanje lozinke
     * @return view
     */
    public function index()
    {
        return view('auth.passwords.reset');
    }

    /*
     *  Author: Samardžija Sanja 17/0372
     *      Postavlja novu lozinku korisnika ako je uneo validne podatke i preusmerava ga na login stranicu
     * @param  array  $data
     * @return \App\User
     */
    public function resetPassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:6|alpha_dash',
            'password' => 'required|min:6|alpha_dash',
            'password_confirm' => 'required_with:password|same:password'
        ];

        $messages = [
            'password.required' => 'Ovo polje je obavezno',
            'password_confirm.required_with' => 'Ovo polje je obavezno',
            'password.min' => 'Lozinka ne sme biti manja od :min',
            'password.alpha_dash' => 'Lozinka može sadržati samo alpa_dash karaktere',
            'password_confirm.same' => 'Lozinke moraju biti iste'
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules, $messages);
        if($validate->fails()){
            return redirect('register')
                ->withErrors($validate)
                ->withInput($data);
        }

        $password = Hash::make($request->old_password);

        if (!Hash::check($request->old_password, Auth::user()->password))
        {
            return redirect('register')
                ->withErrors(['old_password' => "Neispravna stara lozinka!"])
                ->withInput($data);
        }
        $user = DB::table('users')->where('username', '=', Auth::user()->username)->first();
        $user->password = Hash::make($request->password);
        $user->update();
        return  redirect('korisnickiProfil')
            ->with('success',"Lozinka uspešno promenjena!");
    }
}
