<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kupac extends Model
{
    //

    protected $primaryKey='user_id';

    protected $fillable = [
        'user_id'
    ];
    public static function pocetna()
    {
        $kupac = new Kupac(['user_id'=>'1']);
        $kupac->save();
    }
}
