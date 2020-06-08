<?php

namespace App\Http\Controllers;

use App\Events\Auction;
use App\User;
use App\Mail\NewPicture;
use App\Picture;
use App\Slikar;
use App\Stil;
use App\Tema;
use DateTime;
use Faker\Provider\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as StorageFile;
use Illuminate\Support\Facades\DB;

/**
 * Class spSlika
 * @package App\Http\Controllers
 * @version 1.0
 * Klasa kontrolera koja upravlja slikama
 */
class spSlika extends Controller
{
    /**
     * Author: Pavićević Vladana 17/0296
     * --------------------------------------
     * spSlika
     * --------------------------------------
     */
    protected $path = "";

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {

        $kupac = Auth::user();
        $path = '/images/avatar.png';
        if($kupac->profilna_slika!=null){
            $path = '/images/users//'.$kupac->profilna_slika;
        }
        $error = [];
        $picture = new Picture();
        $teme = "";
        return view('slika_form', compact('error', 'picture', 'teme', 'path'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @deprecated
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Funkcija za objavljivanje nove slike
     *
     * @param Request $request
     * @return Redirector
     */
    public function store(Request $request)
    {
        $rules = [
            'file_path' => 'required|image',
            'naziv'=>'required',
            'autor'=>'required',
            'opis'=>'required|min:10',
//            'aukcijaFlag'=>'required',
            'danIstekaAukcije'=>'required_with:aukcijaFlag',

        ];
        $messages = [
            'file_path.required'=> 'Morate prvo izabrati fajl!',
            'file_path.image'=>'Izaberite sliku.Format slike nije podržan.',
            'naziv.required'=>'Ovo polje je obavezno!',
            'autor.required'=>'Ovo polje je obavezno!',
            'opis.required'=>'Ovo polje je obavezno!',
            'opis.min'=>'Opis mora imati najmanje :min karaktera!',
//            'aukcijaFlag.required'=>'Ovo polje je obavezno!',
            'danIstekaAukcije.required_with'=>'Ovo polje je obavezno uz aukcija flag!',

        ];
        $error = [];
        $aukcija = 0;
        $picture = new Picture();
//        dd($request->all());
        $validate = Validator::make($request->all(), $rules, $messages);
        if($validate->fails()){
//        dd($request->all());
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $path = '\images\\' . Auth::user()->username . '\\' . $_FILES['file_path']['name'];
        // check if painter has a directory
        $directories = Storage::directories('\images\\');
        $b = true;
        foreach ($directories as $d) {
            if (basename($d) == Auth::user()->username)
                $b = false;
        }
        if ($b) {
            Storage::makeDirectory(public_path() . '\images\\' . Auth::user()->username);

        } else {
            // check if picture already on painter profile
            $files = StorageFile::allFiles(public_path() . '\images\\' . Auth::user()->username);
            $b = false;
            foreach ($files as $d) {
                if ($d->getFilename() == $_FILES['file_path']['name']) {
                    $b = true;
                }
            }
            if ($b) {
                $error['file_path'] = "***Ova slika već postoji na vašem profilu!***";
                return redirect()->back()
                    ->withErrors(['file_path' => "***Ova slika već postoji na vašem profilu!***"])
                    ->withInput();
            }
        }
//        dd($request->stil_id);
        $picture->stil_id = DB::table('stils')->where('naziv', '=' ,$request->stil_id)->first()->id;
        $request->merge(['stil_id' => $picture->stil_id]);
        $picture->smer = $request->get('smer');

//            dd($request->file('file_path'));
        $file = $request->file('file_path')
            ->move( public_path() . '\images\\' . Auth::user()->username, $request->file('file_path')->getClientOriginalName());

        $picture->path = $path;

//        dd($flag);
            $picture->naziv = $request->get('naziv');

            $picture->autor = $request->get('autor');

            $picture->opis = $request->get('opis');

        if($request->get('aukcijaFlag') != null){
            $picture->danIstekaAukcije = new DateTime($request->get('danIstekaAukcije'));
            $request->merge(['danIstekaAukcije' => $picture->danIstekaAukcije]);

            $aukcija = 2;
            if($request->get('aukcijaFlag') == 'javnaAukcija') {
                $aukcija = 1;
                if ($request->get('cena') == null) {
                    return redirect()->back()
                        ->withErrors(['cena' => "Morate postaviti cenu!"])
                        ->withInput();
                }
            } else {
                $cena = preg_replace('/[^0-9]/i', '',$request->get('cena'));
                $picture->cena = $cena;
            }
        } else if($request->get('cena') == null) {
            return redirect()->back()
                ->withErrors(['cena' => "Morate postaviti cenu!"])
                ->withInput();
        } else {
            $cena = preg_replace('/[^0-9]/i', '',$request->get('cena'));
            $picture->cena = $cena;
        }

        $picture->aukcijaFlag = $aukcija;
        $request->merge(['aukcijaFlag' => $aukcija]);

        $korid = Auth::id();
        $slikar = Slikar::where('user_id', $korid)->get()[0];
        $picture->user_id = $korid;
        if(count(Picture::where('path', $picture->path)->get()) == 0){
            $picture->save();

            $users = $slikar->subscribed;
            foreach ($users as $user){
                $korisnik = User::find($user->user_id);
                $data = ['username' => $korisnik->username, 'id' => $picture->id];
                Mail::send('email.NewPictureNotification', $data, function ($message) use ($korisnik) {
                    $message->to($korisnik->email)->subject('Nova slika');
                });
            }
        } else {
            Picture::where('path', $picture->path)->get()[0]->update($request->all());
        }
        event(new Auction($picture));
        $picture = Picture::where('path', $picture->path)->get()[0];

        $teme = explode(", ", $request->get('teme'));
        foreach ($teme as $naziv){
            $temas = Tema::where('tema', $naziv)->get();
            if(count($temas) == 0){
                $tema = new Tema();
                $tema->tema = $naziv;
                $tema->save();
            }
            $tema = Tema::where('tema', $naziv)->get()[0];
            $picture->temas()->attach($tema->id);
        }
        return redirect('/picture/'.$picture->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @deprecated
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $error = [];
        $picture = Picture::findOrFail($id);
        $picture->danIstekaAukcije = new DateTime($picture->danIstekaAukcije);
        $t = $picture->temas;
        $nazivi = [];
        foreach ($t as $tema){
            array_push($nazivi, $tema->tema);
        }
        $teme = implode(', ', $nazivi);
        return view('slika_form', compact('error', 'picture', 'teme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return void
     *@deprecated
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Funkcija za brisanje odredjene slike.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy($id)
    {
        $picture = Picture::findOrFail($id);
        if(!is_null($picture)){
            StorageFile::delete(public_path() . $picture->path);
        }
        $picture->delete();
    }
    /**
     * Author: 17/0372 Sanja Samardžija
     * Funkcija za čuvanje slike
     *
     * @param Request $request
     * @return JsonResponse
     */
    /*
        public function postSlika(Request $request){
            $rules = [
                'file_path' => 'required|image',
            ];
            $messages = [
                'file_path.required'=> 'Morate prvo izabrati fajl!',
                'file_path.image'=>'Izaberite sliku.Format slike nije podržan.',
            ];
    //        dd($request->all());
            $validate = Validator::make($request->all(), $rules, $messages);
            if($validate->fails()){
    //            dd("failed");
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }

            $path = '\images\\' . Auth::user()->username . '\\' . $_FILES['file_path']['name'];
            preg_match('/[^\.]+/',$_FILES['file_path']['name'], $naziv);
            $directories = Storage::directories('\images\\');
            $b = true;;

            foreach ($directories as $d){
                if(basename($d) == Auth::user()->username)
                    $b = false;
            }
            if($b) {
                Storage::makeDirectory(public_path() . '\images\\' . Auth::user()->username);

            } else {
                $files = StorageFile::allFiles(public_path() . '\images\\'. Auth::user()->username);
                $b = false;
                foreach ($files as $d){
                    if($d->getFilename() == $_FILES['file_path']['name']) {
                        $b = true;
                    }
                }
                if($b) {
                    $error = "<b>Ova slika već postoji na vašem profilu.</b>";
                    return response()
                        ->json(array('path' => "error", 'naziv' => $error), 200);
                }
            }
    //        dd($request->file_path);
            return response()->json(array('path'=> $path, 'naziv'=>$naziv[0], 'ini'=>"ok"), 200);
           /* $p = config_path('global.php');
            preg_match('/(["](.*)["])/', file_get_contents(config_path('global.php')), $matches);
            $oldValue = $matches[2];
            if($oldValue != '') {
    //            dd($request->path);
    //            $ret = StorageFile::delete(public_path() . $oldValue);
                $this->unsaveSlika();
               /* return response()
                    ->json(array('path' => "error", 'naziv' => $ret . ' ' . $request->path), 200);
            }

            $file = $request->file('file_path')
                ->move( public_path() . '\images\\' . Auth::user()->username, $request->file('file_path')->getClientOriginalName());

            $p = config_path('global.php');
            preg_match('/(["](.*)["])/', file_get_contents(config_path('global.php')), $matches);
            $oldValue = $matches[2];
    //        config(['global.path' => $path]);
            // rewrite file content with changed data
            if (file_exists($p)) {
                // replace current value with new value
                file_put_contents(
                    $p, str_replace(
                        '\'path\' => "' . $oldValue . '"',
                        '\'path\' => "' . $path . '"',
                        file_get_contents($p)
                    )
                );
            }

            preg_match('/(["](.*)["])/', file_get_contents(config_path('global.php')), $matches);
            return response()->json(array('path'=> $path, 'naziv'=>$naziv[0], 'ini'=>$matches[2]), 200);*/
    }

    /**
     * Author: 17/0372 Sanja Samardžija
     * Funkcija za brisanje slike
     *
     * @param void
     * @return JsonResponse
     *//*
    public function unsaveSlika(){
        $p = config_path('global.php');
        preg_match('/(["](.*)["])/', file_get_contents($p), $matches);
//        return response()->json(array('path'=> $matches[2], 'ret'=>"skks/ksksks"), 200);
        if(file_exists(public_path() . $matches[2]))
            $ret = StorageFile::delete(public_path() . $matches[2]);

//        config(['global.path' => ""]);
//        preg_match('/(["](.*)["])/', file_get_contents(config_path('global.php')), $matches);
//        config(['global.path' => $path]);
        // rewrite file content with changed data
        if (file_exists($p)) {
            // replace current value with new value
            file_put_contents(
                $p, str_replace(
                    '\'path\' => "' . $matches[2] . '"',
                    '\'path\' => ""',
                    file_get_contents($p)
                )
            );
        }

        return response()->json(array('path'=>config('global.path'), 'ret'=>$ret), 200);
    }
}*/
