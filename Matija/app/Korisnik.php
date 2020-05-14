<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Korisnik extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [
        'username', 'password', 'mail', 'profilna_slika', 'brPrijava', 'brUspesnihPrijava'
    ];
    /**
     /*  Author: Sanja Samardžija 17/0372
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public static function pocetna(){

        $kupac = new Korisnik(['username'=>'kupac', 'password'=>'123', 'mail'=>'a@a.com', 'profilna_slika'=>'/images/tamara.jpg',
            'brPrijava' => 0, 'brUspesnihPrijava' => 0
        ]);
        $kupac->save();

        $slikar = new Korisnik(['username'=>'slikar', 'password'=>'1234', 'mail'=>'b@a.com', 'profilna_slika'=>'/images/drazend.jpg',
            'brPrijava' => 0, 'brUspesnihPrijava' => 0
        ]);
        $slikar->save();

    }
}
