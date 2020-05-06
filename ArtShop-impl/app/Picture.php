<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Picture extends Model
{
    //

    protected $fillable = [
        'korisnik_id', 'stil_id', 'naziv', 'ocena', 'opis', 'path', 'aukcijaFlag', 'danIstekaAukcije'
    ];

    public static function insertujSlike(){
        /*$picture = new Picture;
        $picture->path = '/images/tamara.jpg';
        $picture->save();

        $picture = new Picture;
        $picture->path = '/images/drazend.jpg';
        $picture->save();

        $picture = new Picture;
        $picture->path = '/images/tamara.jpg';
        $picture->save();*/

        $picture = new Picture;
        $picture->path = 'images/Gerry%20Miles/underwater-painting.-gerry-miles.jellyfish.jpg';
        $picture->save();
    }


    public static function displayAll(){
        $pictures = Picture::all();

        foreach ($pictures as $picture){
            echo "<img alt='slika' src=".$picture->path."><br>";
        }
    }

    public static function pocetna()
    {
        $picture = new Picture(['korisnik_id'=>'2', 'stil_id'=>1, 'path'=>'/images/logo.png', 'naziv'=>'Logo', 'opis'=>'logo sajta',
                'ocena'=>11, 'aukcijaFlag' => false, 'danIstekaAukcije' => '2020-05-10 18:00:00']);
        $picture->save();
    }

}
