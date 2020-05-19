<?php

namespace App\Http\Controllers;

use App\Korpa;
use App\Picture;
use App\Podaci;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

/**
 * Class spKorpa
 * @package App\Http\Controllers
 * @version 1.0
 *
 * Kontroler za prikaz sadrzaja korpe
 */
class spKorpa extends Controller
{
    /**
     * Author: Pešić Matija 17/0428
     * --------------------------------------
     * spZKorpa
     * --------------------------------------
     */

    /**
     * Prikazuje sadrzaj korpe
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //

        $korid = Auth::id();
        $slikeUKorpi = Korpa::dohvatiSlikeUKorpi($korid);
        //dd($slikeUKorpi);
        //echo var_dump($slikeUKorpi);
        //echo "==============================================================";
        $autori = Picture::dohvatiAutoreSlika($slikeUKorpi);
        //echo "==============================================================";
        $stilovi = Picture::dohvatiStiloveSlika($slikeUKorpi);
        /*foreach ($slikeUKorpi as $slika){
            echo $slika->path. "<br>";
        };
        foreach ($autori as $slika){
            echo $slika->username. "<br>";
        };
        foreach ($stilovi as $slika){
            echo $slika->naziv. "<br>";
        };
        return;*/
        //echo count($slikeUKorpi);
        $kupac = Auth::user();
        $path = 'images\\avatar.png';
        if($kupac->profilna_slika!=null){
            $path = 'images\\users\\'.$kupac->profilna_slika;
        }
        $pogled = view('.korpa', compact('path'))->with('slike_u_korpi', $slikeUKorpi)->with('slikari', $autori)->with('stilovi', $stilovi);
        return $pogled;


    }

    /**
     * unused
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @deprecated
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(Request $request)
    {


        /*$request->korisnik_id=1;
        //return $request->all();
        Podaci::create($request->all());
        return redirect('/kupac_forma');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @deprecated
     */
    public function show($id)
    {
        //
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     * @deprecated
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @deprecated
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Funckija koja uklanja sliku zadatog id-ja iz korpe
     *
     * @param  int  $id
     * @return Redirector
     */
    public function destroy($id)
    {
        //


        Picture::onlyTrashed()->find($id)->restore();
        $slika = Korpa::find($id)->delete();
        return redirect('/korpa');
    }



}
