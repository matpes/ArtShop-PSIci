<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slikar extends Model
{
    //
    protected $fillable = [
        'korisnik_id', 'sumaOcena', 'brOcenjenihSlika'
    ];

    public static function pocetna()
    {
        $kupac = new Slikar(['korisnik_id'=>'2', 'sumaOcena'=>0, 'brOcenjenihSlika'=>0]);
        $kupac->save();
    }

}
