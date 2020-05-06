<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korpa extends Model
{
    //

    protected $fillable = [
        'picture_id', 'korisnik_id'
    ];

    public static function pocetna()
    {
        $kupovina = new Korpa(['picture_id'=>1, 'korisnik_id'=>1]);
        $kupovina->save();
    }

    public static function dohvatiSlike()
    {
        $korpa = Korpa::all()->where('korisnik_id', 1);
        //echo $korpa;

        foreach ($korpa as $item){
            $slika = Picture::find($item->picture_id);
        }
        return $slika->path;
    }
}
