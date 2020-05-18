<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Korpa extends Model
{
    //

    protected $primaryKey = 'picture_id';

    protected $fillable = [
        'picture_id', 'user_id'
    ];

    public static function pocetna()
    {
        $kupovina = new Korpa(['picture_id'=>2, 'user_id'=>1]);
        $kupovina->save();
        $kupovina = new Korpa(['picture_id'=>3, 'user_id'=>1]);
        $kupovina->save();
        $kupovina = new Korpa(['picture_id'=>4, 'user_id'=>1]);
        $kupovina->save();
    }

    public static function dohvatiSlike(&$cena)
    {
        $cena = 0;
        $korid = Auth::id();
        $korpa = Korpa::all()->where('user_id', $korid);
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
        $korpa = Korpa::all()->where('user_id', $id);
        $slike=[];
        foreach ($korpa as $item){
            $currSlika = Picture::onlyTrashed()->find($item->picture_id);
            array_push($slike, $currSlika);
        }
        return $slike;
    }
}
