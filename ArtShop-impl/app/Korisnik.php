<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    //
    protected $fillable = [
        'username', 'password', 'mail', 'profilna_slika', 'brPrijava', 'brUspesnihPrijava'
    ];



    public static function pocetna(){

        $kupac = new Korisnik(['username'=>'kupac', 'password'=>'123', 'mail'=>'a@a.com', 'profilna_slika'=>'/images/tamara.jpg',
            'brPrijava' => 0, 'brUspesnihPrijava' => 0
        ]);
        $kupac->save();

        $slikar = new Korisnik(['username'=>'slikar', 'password'=>'1234', 'mail'=>'b@a.com', 'profilna_slika'=>'/images/drazend.jpg',
            'brPrijava' => 0, 'brUspesnihPrijava' => 0
        ]);
        $slikar->save();

    }
}
