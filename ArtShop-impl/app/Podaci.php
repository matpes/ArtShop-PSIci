<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podaci extends Model
{
    //

    protected $fillable = [
        'korisnik_id', 'ime', 'prezime', 'adresa', 'grad', 'brUlice', 'brTelefona', 'ZIPCode', 'metodNaplate'
    ];

}
