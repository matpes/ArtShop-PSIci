<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    //
    protected $fillable = [
        'korisnik_id', 'picture_id', 'tekst', 'vreme'
    ];
}
