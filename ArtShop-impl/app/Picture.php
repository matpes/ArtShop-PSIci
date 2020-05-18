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
        'user_id', 'stil_id', 'naziv', 'autor', 'cena', 'opis', 'path', 'aukcijaFlag', 'danIstekaAukcije', 'smer'
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
        $picture = new Picture(['user_id'=>'1', 'stil_id'=>1, 'path'=>'/images/Gemma_Gene/Helium%20ballons.png', 'naziv'=>'helium', 'opis'=>'Baloni puni helijuma', 'aukcijaFlag' => 0, 'cena'=>1000, 'danIstekaAukcije' => '2020-05-10 18:00:00']);
        $picture->save();
        $picture = new Picture(['user_id'=>'1', 'stil_id'=>1, 'path'=>'/images/Samantha_French/Underwater%20tranquility.png', 'naziv'=>'mirnoca', 'opis'=>'Podzemna mirnoca',
            'cena'=>11000, 'aukcijaFlag' => 1, 'danIstekaAukcije' => '2020-05-10 18:00:00']);
        $picture->save();
        $picture = new Picture(['user_id'=>'1', 'stil_id'=>1, 'path'=>'/images/Gerry_Miles/underwater-painting.-gerry-miles.jellyfish.jpg', 'naziv'=>'Logo', 'opis'=>'logo sajta',
            'cena'=>11000, 'aukcijaFlag' => 2, 'danIstekaAukcije' => '2020-05-10 18:00:00']);
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
            $autor = User::find($slika->user_id);
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

        $slikar = Slikar::find($slika->user_id);
        return $slikar;
    }

    public function teme(){
        return $this->belongsToMany('App\Tema')->get();
    }

    public function temas(){
        return $this->belongsToMany('App\Tema');
    }

    public function getUcesnika($id){
        $ret =  $this->belongsToMany('App\Kupac','kupac_picture', 'picture_id', 'user_id');
        //dd($ret);
        $ret = $ret->where('kupac_picture.'.'user_id', $id);
        return $ret;
    }

    public function getSveUcesnike(){
        return $this->belongsToMany('App\User','kupac_picture', 'picture_id', 'user_id')->get();
    }


}
