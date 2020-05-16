<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podaci extends Model
{
    //

    protected $fillable = [
        'user_id', 'ime', 'prezime', 'adresa', 'grad', 'brUlice', 'brTelefona', 'ZIPCode', 'metodNaplate'
    ];


}
