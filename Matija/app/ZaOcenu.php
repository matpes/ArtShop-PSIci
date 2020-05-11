<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZaOcenu extends Model
{
    //

    protected $fillable = [
        'picture_id', 'korisnik_id', 'ocena'
    ];
}
