<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
