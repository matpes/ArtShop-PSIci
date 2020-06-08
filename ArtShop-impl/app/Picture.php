<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;

/**
 * Picture – model klasa za upravljanje tabelom pictures
 *
 * @version 1.0
 */
class Picture extends Model
{
    //Naznaka da kada se slika obrise iz baze se zapravo ne brise, nego se samo oznacava kao obrisana, a i dalje joj se moze pristupati na odredjene nacine
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'stil_id', 'naziv', 'autor', 'cena', 'opis', 'path', 'aukcijaFlag', 'danIstekaAukcije', 'smer'
    ];

    /*
     * @deprecated
     */
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

    /*
     * @deprecated
     */
    public static function displayAll(){
        $pictures = Picture::all();

        foreach ($pictures as $picture){
            echo "<img alt='slika' src=".$picture->path."><br>";
        }
    }

    /**
     * funkcija koja popunjava pictures u bazi, ciji je slikar korisnik sa id=1
     *
     * @deprecated
     *
     * @return void
     */
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

    /**
     * funkcija koja za prosledjen niz slika vraca niz stilova tih slika, u odgovarajucem poretku
     *
     * @param array $slike - slike za koje se dohvate stilovi
     *
     * @return array
     */
    public static function dohvatiStiloveSlika($slike){
        $stilovi = [];
        foreach ($slike as $slika){
            $stil = Stil::find($slika->stil_id);

            array_push($stilovi, $stil);
        }
        return $stilovi;
    }

    /**
     * funkcija koja za prosledjen niz slika vraca niz autora tih slika, u odgovarajucem poretku
     *
     * @param array $slike - slike za koje se dohvate autori
     *
     * @return array
     */
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

    /**
     * funkcija koja za prosledjenu sliku vraca njen stil
     *
     * @param Picture $slika - slike za koju se dohvata stil
     *
     * @return Stil
     */
    public static function dohvatiStil($slika){

        $stil = Stil::find($slika->stil_id);
        return $stil;
    }

    /**
     * funkcija koja za prosledjenu sliku vraca njenog autora
     *
     * @param Picture $slika - slike za koju se dohvata autor
     *
     * @return Slikar
     */
    public static function dohvatiAutora($slika){

        $slikar = Slikar::find($slika->user_id);
        return $slikar;
    }

    /**
     * funkcija koja dohvata teme slike i vraca ih kao kolekciju, tj. niz
     *
     * @return Collection
     */
    public function teme(){
        return $this->belongsToMany('App\Tema')->get();
    }


    public static function sveTeme($pictures){
        $ret = [];
        foreach ($pictures as $picture){
            //$vari = $picture->belongsToMany('App\Tema');
            //dd($vari);
            array_push($ret, $picture->teme());
        }
        return $ret;
    }


    /**
     * funkcija koja dohvata teme slike i vraca ih kao objekat baze
     *
     * @return BelongsToMany
     */
    public function temas(){
        return $this->belongsToMany('App\Tema');
    }

    /**
     * funkcija koja dovata objekat kupca ako je ucestvovao na aukciji. Ako nije, vraca null
     *
     * @return BelongsToMany
     */
    public function getUcesnika($id){
        $ret =  $this->belongsToMany('App\Kupac','kupac_picture', 'picture_id', 'user_id');
        //dd($ret);
        $ret = $ret->where('kupac_picture.'.'user_id', $id);
        return $ret;
    }

    /**
     * funkcija koja vraca niz svih ucesnika koji su ucestvovali na aukciji
     *
     * @return Collection
     */
    public function getSveUcesnike(){
        return $this->belongsToMany('App\User','kupac_picture', 'picture_id', 'user_id')->get();
    }

    /**
     * funkcija koja odredjuje pobednika i gubirnike aukcije
     *
     * @param Collection &$pobednik - niz gde ce se smestiti jedan jedini pobednik
     *
     * @param Collection &$gubitnici - niz gde ce se smestiti ucesnici koji nisu pobedili na aukciji
     *
     * @return void
     */
    public function krajAukcije(&$pobednik, &$gubitnici){
        $ret =  $this->belongsToMany('App\Kupac','kupac_picture', 'picture_id', 'user_id')->orderBy('cena', 'DESC')->get();

        $gubitnici = [];
        $pobednik = [];
        for($i = 0; $i < count($ret); $i++){
            if($i == 0){
                array_push($pobednik, $ret[$i]);
            }else{
                array_push($gubitnici, $ret[$i]);
            }
        }
    }

}
