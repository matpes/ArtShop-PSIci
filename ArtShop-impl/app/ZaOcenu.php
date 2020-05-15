<?php

namespace App;

use App\Picture;
use Illuminate\Database\Eloquent\Model;
class ZaOcenu extends Model
{
    //

    protected $primaryKey = 'picture_id';

    protected $fillable = [
        'picture_id', 'korisnik_id', 'ocena'
    ];


    public static function zaOcenu($id){
        $id_slike = ZaOcenu::all()->where('korisnik_id', $id);
        $slike = [];
        foreach ($id_slike as $item){
            $picture = Picture::onlyTrashed()->find($item->picture_id);

            array_push($slike, $picture);
        }
        return $slike;
    }
}
