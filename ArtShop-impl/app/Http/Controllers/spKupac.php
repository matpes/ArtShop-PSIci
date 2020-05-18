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
use Illuminate\Support\Facades\Auth;

class spKupac extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $cena = 0;
        $slikeUKorpi = Korpa::dohvatiSlike($cena);
        /*foreach ($slikeUKorpi as $slika){
            echo $slika. "<br>";
        };*/
        $pogled = view('.podaci_form')->with('slike', $slikeUKorpi)->with('cena', $cena);
        return $pogled;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "I am method that creates stuff";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return "this is the show method yayyyy" . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function subscribe(Request $request){
        $id = $request->slikar;
        $korid = Auth::id();
        $slikar = Slikar::find($id);
        $slikar->dodajSubscribera($korid);
        return redirect('/picture/'.$request->picture);
    }

    function pocetnaBaza(){
        //Korisnik::pocetna();
        //Kupac::pocetna();
        //Slikar::pocetna();
        Picture::pocetna();
        Korpa::pocetna();
    }
}
