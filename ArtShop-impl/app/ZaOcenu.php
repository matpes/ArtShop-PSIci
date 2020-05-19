<?php

namespace App;

use App\Picture;
use Illuminate\Database\Eloquent\Model;

/**
 * ZaOcenu – model klasa za upravljanje slikama koje treba da se ocene
 *
 * @version 1.0
 */
class ZaOcenu extends Model
{
    //

    protected $primaryKey = 'picture_id';

    protected $fillable = [
        'picture_id', 'user_id', 'ocena'
    ];

    /**
     * funkcija koja dohvata slike koje je korisnik kupio, a jos nisu ocenjene
     * @param $id - id korinsika
     * @return array - slike za ocenu
     */
    public static function zaOcenu($id){
        $id_slike = ZaOcenu::all()->where('user_id', $id);
        $slike = [];
        foreach ($id_slike as $item){
            $picture = Picture::onlyTrashed()->find($item->picture_id);

            array_push($slike, $picture);
        }
        return $slike;
    }
}
