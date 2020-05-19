<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Korpa;
use App\Kupac;
use App\Picture;
use App\Podaci;
use App\Slikar;
use App\ZaOcenu;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class spKupac
 * @package App\Http\Controllers
 * @version 1.0
 *
 * Klasa za kupca, ali se uglavnom koristi za prikaz forme sa podacima
 */
class spKupac extends Controller
{
    /**
     * Author: Pešić Matija 17/0428
     * --------------------------------------
     * spKupac
     * --------------------------------------
     */

    /**
     * Prikazuje formu koju treba popuniti.
     *
     * @return View
     */
    public function index()
    {
        //

        $kupac=Auth::user();
        $path = '/images/avatar.png';
        if($kupac->profilna_slika!=null){
            $path = '/images/users//'.$kupac->profilna_slika;
        }
        $cena = 0;
        $slikeUKorpi = Korpa::dohvatiSlike($cena);
        /*foreach ($slikeUKorpi as $slika){
            echo $slika. "<br>";
        };*/
        $pogled = view('.podaci_form')->with('slike', $slikeUKorpi)->with('cena', $cena)->with('path', $path);
        return $pogled;


    }

    /**
     * Show the form for creating a new resource.
     * @deprecated
     * @return string
     */
    public function create()
    {
        //
        return "I am method that creates stuff";
    }

    /**
     * Funkcija za preuzimanje podataka iz baze i njihovo pamcenje.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirector
     */
    public function store(Request $request)
    {

        $korid = Auth::id();
        //return $request->all();
        $podaci = Podaci::firstOrNew(['user_id'=>Auth::id()]);
        //Podaci::create($request->all());
        $podaci->ime = $request->ime;
        $podaci->prezime = $request->prezime;
        $podaci->adresa = $request->adresa;
        $podaci->grad = $request->grad;
        $podaci->brUlice = $request->brUlice;
        $podaci->brTelefona = $request->brTelefona;
        $podaci->ZIPCode = $request->ZIPCode;
        $podaci->metodNaplate = $request->metodNaplate;
        $podaci->save();
        //PREBACIVANJE U TABELU ZA OCENE
        $slike = Korpa::all()->where('user_id', '=', Auth::id());
        foreach ($slike as $slika){
            $zaOcenu = new ZaOcenu;
            $zaOcenu->picture_id = $slika->picture_id;
            $zaOcenu->user_id = $slika->user_id;
            $zaOcenu->ocena = 0;
            $zaOcenu->save();
            $slika->delete();
        }
        return redirect('/korpa');
    }

    /**
     * Display the specified resource.
     * @deprecated
     * @param  int  $id
     * @return string
     */
    public function show($id)
    {
        //
        return "this is the show method yayyyy" . $id;
    }

    /**
     * Show the form for editing the specified resource.
     * @deprecated
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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

    /**
     * Funckija koja iz forme preuzima podatke o korisniku koji zeli da se pretplati na slikara cija je slika
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|Redirector
     */
    public function subscribe(Request $request){
        $id = $request->slikar;
        $korid = Auth::id();
        $slikar = Slikar::find($id);
        $slikar->dodajSubscribera($korid);
        return redirect('/picture/'.$request->picture);
    }

    /**
     * @deprecated
     * @return void
     */
    function pocetnaBaza(){
        //Korisnik::pocetna();
        //Kupac::pocetna();
        //Slikar::pocetna();
        Picture::pocetna();
        Korpa::pocetna();
    }
}
