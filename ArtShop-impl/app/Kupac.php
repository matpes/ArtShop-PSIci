<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kupac extends Model
{
    //
    protected $fillable = [
        'korisnik_id'
    ];
    public static function pocetna()
    {
        $kupac = new Kupac(['korisnik_id'=>'1']);
        $kupac->save();
    }
}
