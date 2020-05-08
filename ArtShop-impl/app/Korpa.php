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
        $kupovina = new Korpa(['picture_id'=>2, 'korisnik_id'=>1]);
        $kupovina->save();
        $kupovina = new Korpa(['picture_id'=>3, 'korisnik_id'=>1]);
        $kupovina->save();
        $kupovina = new Korpa(['picture_id'=>4, 'korisnik_id'=>1]);
        $kupovina->save();
    }

    public static function dohvatiSlike()
    {
        $korpa = Korpa::all()->where('korisnik_id', 1);
        //echo $korpa;

        $slika =[];
        foreach ($korpa as $item){
            $currSlika = Picture::find($item->picture_id);
            $currPAth = $currSlika->path;
            array_push($slika, $currPAth);
        }
        return $slika;
    }
}
