<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    //
    protected $fillable = [
        'username', 'password', 'mail', 'profilna_slika', 'brPrijava', 'brUspesnihPrijava'
    ];
}
