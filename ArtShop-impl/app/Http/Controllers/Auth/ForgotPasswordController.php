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
        $user = DB::table('users')->where('email', '=',$request->email)->first();
        if (is_null($user)) {
            return redirect()->back()
                ->withErrors(['email' => "Korisnik sa unetom email adresom ne postoji u bazi!"])
                ->withInput();
        } else {
            $random = Str::random(8);
            $password = Hash::make($random);
            DB::table('users')
                ->where('id', '=', $user->id)
                ->limit(1)
                ->update(['password' => $password]);

            Mail::send('auth/passwords/mailer', array('name'=>$user->username, 'new_password' => $random ), function($message) use ($request) {
                $email = $request->email;
                $message->to($email/*, $email->subject('ArtShop')*/)->subject("NOVA SIFRA");
            });
            return redirect('login')
                ->with('success', "Email za resetovanje lozinke poslat na datu adresu!");
        }
    }

}
