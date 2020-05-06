<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Korpa;
use App\Kupac;
use App\Picture;
use App\Slikar;
use Illuminate\Http\Request;

class spKupac extends Controller
{
    //



    function formaZaPodatke(){
        $slikeUKorpi = Korpa::dohvatiSlike();
        //echo $slikeUKorpi;
        $pogled = view('.podaci_form')->with('slika', $slikeUKorpi);
        return $pogled;
    }


    function pocetnaBaza(){
        //Korisnik::pocetna();
        //Kupac::pocetna();
        //Slikar::pocetna();
        //Picture::pocetna();
        //Korpa::pocetna();
    }
}
