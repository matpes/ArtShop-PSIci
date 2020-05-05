<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slikar extends Model
{
    //
    protected $fillable = [
        'korisnik_id', 'sumaOcena', 'brOcecnjenihSlika'
    ];
}
