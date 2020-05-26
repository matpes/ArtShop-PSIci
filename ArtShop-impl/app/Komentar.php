<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Komentar extends Model
{
    //
    protected $fillable = [
        'user_id', 'picture_id', 'tekst', 'vreme'
    ];



    public static function insertujKomentar($k_id, $p_id, $text, $vreme){


        $komentar = new Komentar;
        $komentar->user_id=$k_id;
        $komentar->picture_id=$p_id;
        $komentar->Vreme=$vreme;
        $komentar->tekst =$text;
        $komentar->save();
    }

    public static function allComments($picture_id){
        //$komentari=Komentar::all();
        //$komentari=$this->belongsToMany('App\Picture');
        $komentari = DB::table('komentars')->where('picture_id', $picture_id)->get();
        $autori= collect([]);
        $both=collect([]);
        foreach($komentari as $komentar){
            $autor=self::getAuthor($komentar);
            $autori->push($autor);
        }
        $both->push($komentari);
        $both->push($autori);
        return $both;

    }

    public static function getAuthor($komentar){

        $autor = User::find($komentar->user_id);
        return $autor;


    }
}
