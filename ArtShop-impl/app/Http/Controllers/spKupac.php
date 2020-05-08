<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Korpa;
use App\Kupac;
use App\Picture;
use App\Podaci;
use App\Slikar;
use Illuminate\Http\Request;

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

        $slikeUKorpi = Korpa::dohvatiSlike();
        /*foreach ($slikeUKorpi as $slika){
            echo $slika. "<br>";
        };*/
        $pogled = view('.podaci_form')->with('slike', $slikeUKorpi);
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

        $request->korisnik_id=1;
        //return $request->all();
        Podaci::create($request->all());
        return redirect('/kupac_forma');
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



    function pocetnaBaza(){
        //Korisnik::pocetna();
        //Kupac::pocetna();
        //Slikar::pocetna();
        Picture::pocetna();
        Korpa::pocetna();
    }
}
