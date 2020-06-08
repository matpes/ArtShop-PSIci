<?php

namespace App\Http\Controllers;


use App\Picture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Concerns\InteractsWithInput;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
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
    protected  $br;
    protected  $cnt;

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
        $user = User::where('id','=',$id)->first();
        if(!is_null($user->picture_path)) {
            Storage::delete('images/users/' . $user->picture_path);
        }
        DB::beginTransaction();
        DB::table('komentars')->where('user_id', '=', $id)->delete();
        DB::table('komentar_korisnik')->where('user_id', '=', $id)->delete();
        DB::table('korpas')->where('user_id', '=', $id)->delete();
        DB::table('podacis')->where('user_id', '=', $id)->delete();
        DB::table('za_ocenus')->where('user_id', '=', $id)->delete();
        if($user->isSlikar) {
            DB::table('slikars')->where('user_id', '=', $id)->delete();
            DB::table('kupac_slikar')->where('slikar_id', '=', $id)->delete();
            DB::table('pictures')->where('user_id', '=', $id)->delete();
        } elseif($user->isAdmin){
            DB::table('admins')->where('user_id', '=', $id)->delete();
        } else{
            DB::table('kupacs')->where('user_id', '=', $id)->delete();
            DB::table('kupac_slikar')->where('kupac_id', '=', $id)->delete();
            DB::table('kupac_picture')->where('user_id', '=', $id)->delete();
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
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function userProfile($id) {
        $user = User::find($id);
        $slikari = null;
        $slike = [];
        $slikariUsername = [];
        //dd($user);

        //*******dodato*******
        //ana
        if($user->isAdmin){
            return redirect('admin');
        }
        //andAna
        if(!$user->isSlikar) {
            //dovlacenje slika slikara koji se prate u $slike
            $slikari = DB::table('kupac_slikar')
                ->where('kupac_id', '=', $id)
                ->select('slikar_id')
                ->get();
            //dd($slikari);
            foreach ($slikari as $s) {
                $sl = Picture::all()->where('user_id', $s->slikar_id);
                array_push($slike, $sl);
                $usernam = User::find($s->slikar_id);
                array_push($slikariUsername, $usernam);
            }

            //dd($slikariUsername);
            //dd($slike);
            //dd($slike[0]);
        } else {
            return redirect()->route('profile.user_new',['id'=>$id]);
        }
        return response()->view('profile.user', ['user'=>$user, 'slike'=>$slike, 'slikariUsername' => $slikariUsername]);
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

        $novo = Picture::all()->sortByDesc('created_at')->take(5);
        //dd($novo);

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
     * @param Request $request
     * @return view
     */
    public function changeProfilePicture(Request $request){

//        dd($request->path);
        $rules = [
            'path' => 'required|image|mimes:jpeg,png,jpg,svg',
        ];
        $messages = [
            'path.required'=> 'Morate prvo izabrati fajl!',
            'path.image'=>' Ovo polje je obavezno',
            'path.mimes' => 'Format slike nije podržan! Podržani formati su: jpeg,png,jpg,svg.',
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

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja vraća tekuću sliku za slikara
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxSlikarProfile(Request $request)
    {
        $id = Auth::id();
        $cnt = $request->cnt;
        $br = $request->br;

        //dovlacenje slika slikara
        $slike = DB::table('pictures')
              ->where('user_id', '=', $id)
              ->get()->toArray();
        $slika = $slike[$cnt];
        if(is_null($slika->cena)){
            $cena = DB::table('kupac_picture')
                ->where('picture_id','=', $slika->id)
                ->orderBy('cena', 'desc')
                ->select('cena')
                ->first();
            if(is_null($cena))
                $cena = '0';
            else
                $cena = $cena->cena;
        } else{
            $cena = $slika->cena;
        }
        //dovlacenje teme prve slike
        $tema = DB::table('picture_tema')
              ->where('picture_tema.picture_id', '=', $slika->id)
              ->join('temas', function ($join) {
                  $join->on('temas.id', '=', 'picture_tema.tema_id');
              })
              ->select('temas.tema')
              ->get()->toArray();

          //            dd($tema);
        $teme = '';
        foreach ($tema as $t){
            $teme = $teme . '   ' . $t->tema;
        }
        $stil = DB::table('stils')
              ->where('id', '=', $slika->stil_id)
              ->select('naziv')
              ->get()->first();
        $num = $cnt+1 . ' / ' . $br;
        if($slika->aukcijaFlag)
            $nacin = 'aukcija';
        else
            $nacin = 'prvom kupcu';
//*/

        //return response()->json(array('n'=>$request->n), 200);

        return response()->json(array('id'=>$slike[$cnt]->id, 'path'=> $slike[$cnt]->path, 'num'=>$num,
            'cena'=>$cena, 'opis'=>$slike[$cnt]->opis,
            'nacin'=>$nacin, 'stil'=>$stil->naziv, 'naziv'=>$slike[$cnt]->naziv,
            'tema'=>$teme, 'cnt'=>$cnt, 'b'=>$br,), 200);
    }

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja vraća početni profil slikara
     *
     * @param integer $id
     * @return view
     */
    public function indexSlikarProfile($id)
    {
      /*  $user = DB::table('users')
            ->where('id', '=', $id)
            ->first();
        $tema = array();
        $aukcija = array();
        $stil = array();
        //dovlacenje slika slikara
        $slike = DB::table('pictures')
            ->where('user_id', '=', $id)
            ->get()->toArray();

        foreach ($slike as $s) {
            $teme = DB::table('picture_tema')
                ->where('picture_tema.picture_id', '=', $s->id)
                ->join('temas', function ($join) {
                    $join->on('temas.id', '=', 'picture_tema.tema_id');
                })
                ->select('temas.tema')
                ->get()->toArray();
//            dd($teme);
            array_push($tema, $teme);
//            dd($tema);
            array_push($aukcija, $s->aukcijaFlag);

            $st = DB::table('stils')
                ->where('id', '=', $s->stil_id)
                ->select('naziv')
                ->get()->first();
            array_push($stil, $st);
        }
//dd($aukcija);
        return response()->view('profile.user_slikar',['novo'=>$slike,
            'user'=>$user, 'auk'=>$aukcija, 'tema'=>$tema, 'stil'=>$stil]);*/
        $cnt = 0;
        $br = 0;
        $user = DB::table('users')
            ->where('id', '=', $id)
            ->first();

        //dovlacenje prve slike slikara
        $slika = DB::table('pictures')
            ->where('user_id', '=', $id);
        $tema = '';
        $stil = '';

        if(!is_null($slika)) {
            $br = $slika->count();
//            dd($br);
            $slika = $slika->first();
            //dovlacenje teme prve slike
            $tema = DB::table('picture_tema')
                ->where('picture_tema.picture_id', '=', $slika->id)
                ->join('temas', function ($join) {
                    $join->on('temas.id', '=', 'picture_tema.tema_id');
                })
                ->select('temas.tema')
                ->get()->toArray();
//            dd($tema);

            $stil = DB::table('stils')
                ->where('id', '=', $slika->stil_id)
                ->select('naziv')
                ->get()->first();
        }
        return response()->view('profile.user_slikar',['novo'=>$slika, 'user'=>$user,
            'tema'=>$tema, 'stil'=>$stil, 'cnt'=>$cnt, 'br'=>$br]);
    }


}

