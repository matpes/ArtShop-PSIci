<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
/**
 * Korpa – model klasa za upravljanje korpom
 *
 * @version 1.0
 */

class Korpa extends Model
{
    //
    //inherited variable
    protected $primaryKey = 'picture_id';

    /**
     * funkcija koja popunjava korpu u bazi za korisnika sa id=1
     *
     * @return void
     */
    public static function pocetna()
    {
        $kupovina = new Korpa(['picture_id'=>2, 'user_id'=>1]);
        $kupovina->save();
        $kupovina = new Korpa(['picture_id'=>3, 'user_id'=>1]);
        $kupovina->save();
        $kupovina = new Korpa(['picture_id'=>4, 'user_id'=>1]);
        $kupovina->save();
    }

    protected $fillable = [
        'picture_id', 'user_id'
    ];

    /**
     * funkcija koja dohvata slike iz korpe, za trenutno ulogovanoh korisnika, a u $cenu smesta sumu cena kupljenih slika
     * Povratna vrednost je niz slika koje se nalaze u korpi korisnika
     *
     * @return array
     */
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
    /**
     * funkcija koja dohvata slike iz korpe, za trenutno ulogovanoh korisnika, a u $cenu smesta sumu cena kupljenih slika
     * Povratna vrednost je niz slika koje se nalaze u korpi korisnika
     *
     * @param int $id - id korisnika za koga se dohvataju slike iz kopre
     * @return array
     *
     * @deprecated
     *
     */
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
