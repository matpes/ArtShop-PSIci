<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Picture;
use App\Slikar;
use App\ZaOcenu;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class spZaOcenu
 * @package App\Http\Controllers
 * Klasa kontrolera za upravljanje slikama koje treba da se ocene
 */
class spZaOcenu extends Controller
{
    //

    /**
     * Author: Pešić Matija 17/0428
     * --------------------------------------
     * spZaOcenu
     * --------------------------------------
     */


    /**
     * Prikaz slika koje treba da se ocene
     *
     * @return View
     */
    public function index()
    {
        //
        $kupac = Auth::user();
        $path = '/images/avatar.png';
        if($kupac->profilna_slika!=null){
            $path = '/images/users//'.$kupac->profilna_slika;
        }
        $slikeZaOcenu = ZaOcenu::zaOcenu(Auth::id());
        $autori = Picture::dohvatiAutoreSlika($slikeZaOcenu);
        return view('.ocene', compact('autori', 'slikeZaOcenu', 'path'));


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
     * Metoda koja preuzima ocenjene slike i osvezava podatke u tabeli slikara.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirector
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        $count = $request->numberOfPics;
        for($i = 0; $i<$count; $i++){
            //echo $i;
            $str = 'pic'.$i;
            $id = $request->$str;
            if($request->$id > 0) {
                $slika = Picture::onlyTrashed()->find($id);
                $slikar = Slikar::find($slika->user_id);
                $slikar->brOcenjenihSlika++;
                $slikar->sumaOcena += $request->$id;
                $slikar->save();
                ZaOcenu::destroy($id);

            }
        }
        return redirect('/zaOcenu');



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
     * @deprecated
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @deprecated
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @deprecated
     * @return void
     */
    public function destroy($id)
    {
        //
    }



}
