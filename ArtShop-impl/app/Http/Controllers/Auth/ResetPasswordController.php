<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Input;
use  Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Auth\Auth;
use Illuminate\Support\Facades\Auth;
use Session;

class ResetPasswordController extends Controller
{
    /*
    | Author: Samardžija Sanja 17/0372                                        |
    |--------------------------------------------------------------------------|
    | Password Reset Controller                                                |
    |--------------------------------------------------------------------------|
    |                                                                          |
    | Kontroler zadužen za resetovanje lozinki kada je korisnik vec ulogovan   |
    | i želi da je promeni                                                     |
    */

    use ResetsPasswords;

    protected $redirectPath = '/home';

    /*
     *  Author: Samardžija Sanja 17/0372
     *      Konstruktor kontrolera koji zabranjuje da bilo kojoj
     *      funkciji ovog kontrolera pristupi neko ko nema status korisnika.
     * @return void
     */
    public function __construct()
    {
         $this->middleware('UserMiddleware');
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
     * @return view
     */
    public function resetPassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|alpha_dash',
            'new_password' => 'required|min:6|alpha_dash',
            'password_confirm' => 'required_with:new_password|same:new_password'
        ];

        $messages = [
            'password.required' => 'Ovo polje je obavezno',
            'new_password.required' => 'Ovo polje je obavezno',
            'password_confirm.required_with' => 'Ovo polje je obavezno',
            'password.min' => 'Lozinka ne sme biti manja od :min karaktera',
            'new_password.min' => 'Lozinka ne sme biti manja od :min karaktera',
            'password.alpha_dash' => 'Lozinka može sadržati samo alpa_dash karaktere',
            'new_password.alpha_dash' => 'Lozinka može sadržati samo alpa_dash karaktere',
            'password_confirm.same' => 'Lozinke moraju biti iste'
        ];
        $data = $request->all();
        $validate = Validator::make($data, $rules, $messages);
        if($validate->fails()){
//            dd($data);
            return redirect()->back()
                ->withErrors($validate)
                ->withInput($data);
        }
//        dd($data);
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password))
        {
            return redirect()->back()
                ->withErrors(['password' => "Neispravna stara lozinka!"])
                ->withInput($data);
        }
        if($request->new_password != $request->password_confirm){
            return redirect()->back()
                ->withErrors(['password_confirm'=>"Lozinke se ne poklapaju!"])
                ->withInput($data);
        }
        if($request->new_password == $request->password){
            return redirect()->back()
                ->withErrors(['password_confirm'=>"Molimo unesite novu lozinku!"])
                ->withInput($data);
        }
        $password = Hash::make($request->new_password);
        DB::table('users')
            ->where('id', '=', $user->id)
            ->limit(1)
            ->update(['password' => $password]);
//        dd($user);
      /*  $user = DB::table('users')
            ->where('id', '=', $user->id)
            ->first();

        $user->password = Hash::make($request->password);
        $user->update();*/
//        dd($user);
        Session::flush();
        Auth::logout();
        return redirect()-> route('login')
            ->with('success',"Uspešno promenjena lozinka! Molimo ponovo se ulogujte sa novom lozinkom.");
        //*/
    }
}
