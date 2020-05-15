<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korpa extends Model
{
    //

    protected $primaryKey = 'picture_id';

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

    public static function dohvatiSlike(&$cena)
    {
        $cena = 0;
        $korpa = Korpa::all()->where('korisnik_id', 1);
        //echo $korpa;

        $slika =[];
        foreach ($korpa as $item){
            $currSlika = Picture::onlyTrashed()->find($item->picture_id);
            $currPAth = $currSlika->path;
            array_push($slika, $currPAth);
            $cena+=$currSlika->cena;
        }
        return $slika;
    }

    public static function dohvatiSlikeUKorpi($id)
    {
        $korpa = Korpa::all()->where('korisnik_id', $id);
        $slike=[];
        foreach ($korpa as $item){
            $currSlika = Picture::onlyTrashed()->find($item->picture_id);
            array_push($slike, $currSlika);
        }
        return $slike;
    }
}
