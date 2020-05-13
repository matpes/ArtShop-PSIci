<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;

class Picture extends Model
{
    //
    use SoftDeletes;

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
        $picture = new Picture(['korisnik_id'=>'2', 'stil_id'=>1, 'path'=>'/images/Gemma_Gene/Helium%20ballons.png', 'naziv'=>'helium', 'opis'=>'Baloni puni helijuma',
                'ocena'=>11, 'aukcijaFlag' => false, 'danIstekaAukcije' => '2020-05-10 18:00:00']);
        $picture->save();
        $picture = new Picture(['korisnik_id'=>'2', 'stil_id'=>1, 'path'=>'/images/Samantha_French/Underwater%20tranquility.png', 'naziv'=>'mirnoca', 'opis'=>'Podzemna mirnoca',
            'ocena'=>11, 'aukcijaFlag' => false, 'danIstekaAukcije' => '2020-05-10 18:00:00']);
        $picture->save();
        $picture = new Picture(['korisnik_id'=>'2', 'stil_id'=>1, 'path'=>'/images/Gerry_Miles/underwater-painting.-gerry-miles.jellyfish.jpg', 'naziv'=>'Logo', 'opis'=>'logo sajta',
            'ocena'=>11, 'aukcijaFlag' => false, 'danIstekaAukcije' => '2020-05-10 18:00:00']);
        $picture->save();
    }


    public static function dohvatiStiloveSlika($slike){
        $stilovi = [];
        foreach ($slike as $slika){
            $stil = Stil::find($slika->stil_id);

            array_push($stilovi, $stil);
        }
        return $stilovi;
    }

    public static function dohvatiAutoreSlika($slike){
        $authors = [];
        foreach ($slike as $slika){
            $autor = Korisnik::find($slika->korisnik_id);
//            echo $autor;
//            echo "<br>";
            array_push($authors, $autor);
        }
        return $authors;
    }

    public static function dohvatiStil($slika){

        $stil = Stil::find($slika->stil_id);
        return $stil;
    }

    public static function dohvatiAutora($slika){

        $slikar = Korisnik::find($slika->korisnik_id);
        return $slikar;
    }

    public function teme(){
        return $this->belongsToMany('App\Tema')->get();
    }

    public function getUcesnika($id){
        $ret =  $this->belongsToMany('App\Kupac','kupac_picture', 'picture_id', 'korisnik_id');
        //dd($ret);
        $ret = $ret->where('kupac_picture.'.'korisnik_id', $id);
        return $ret;
    }

    public function getSveUcesnike(){
        return $this->belongsToMany('App\Korisnik','kupac_picture', 'picture_id', 'korisnik_id')->get();
    }


}
