<?php


namespace App\Http\Controllers\Auth;


use App\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use  Illuminate\Support\Facades\Input;
use  Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\Auth;

class ForgotPasswordController extends Controller
{

    /*
    | Author: Samardžija Sanja 17/0372                                         |
    |--------------------------------------------------------------------------|
    | Forgot Password Reset Controller                                         |
    |--------------------------------------------------------------------------|
    |                                                                          |
    | Kontroler zadužen za resetovanje lozinki koje su zaboravljene            |
    |                                                                          |
    */

    use ResetsPasswords;

    /*
     *  Author: Samardžija Sanja 17/0372
     *      Konstruktor kontrolera koji zabranjuje da bilo kojoj
     *      funkciji ovog kontrolera pristupi neko ko nema status gosta.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('GuestMiddleware');
    }

    /*
     *  Author: Samardžija Sanja 17/0372
     *      Prikazuje stranicu za zaboravljene lozinke
     * @return view
     */
    public function index()
    {
        return view('auth.passwords.email');
    }

    /*
     *  Author: Samardžija Sanja 17/0372
     *      Resetuje lozinku korisnika ako je uneo validne podatke i preusmerava ga na login stranicu
     * @param  array  $data
     * @return \App\User
     */
    public function forgotPassword(Request $request)
    {
        $user = DB::table('users')->where('mail', '=',$request->email)->first();
        if (is_null($user)) {
            return redirect('password/request')
                ->withErrors(['email' => "Korisnik sa unesenom email adresom ne postoji u bazi!"])
                ->withInput();
        } else {
            $random = Str::random(8);
            $user = User::where('username', '=', $user->username)->first();
            $user->password = Hash::make($random);
            $user->update();

            Mail::send('reauth/passwords/mailers', array('name'=>$user->name, 'new_password' => $random ), function($message)
            {
                $email = Request::getCurrentRequest()->email;
                $message->to($email, $email->subject('ArtShop'));
            });
            return redirect('login')
                ->with('success', "Email za resetovanje lozinke poslat na datu adresu!");
        }
    }

}
