<?php

namespace App\Http\Controllers;

use App\Korpa;
use App\Picture;
use App\Podaci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class spKorpa extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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


        Picture::onlyTrashed()->find($id)->restore();
        $slika = Korpa::find($id)->delete();
        return redirect('/korpa');
    }



}
