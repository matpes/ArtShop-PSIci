<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slikar extends Model
{
    //
    protected $fillable = [
        'user_id', 'sumaOcena', 'brOcenjenihSlika'
    ];

    protected $primaryKey ='user_id';

    public static function pocetna()
    {
        $kupac = new Slikar(['user_id'=>'2', 'sumaOcena'=>0, 'brOcenjenihSlika'=>0]);
        $kupac->save();
    }

    public function subscribed(){
        return $this->belongsToMany('App\Kupac', 'kupac_slikar', 'slikar_id', 'kupac_id');
    }


    public function dodajSubscribera($id){
        $this->belongsToMany('App\Kupac', 'kupac_slikar', 'slikar_id', 'kupac_id')->attach($id);

    }


    public function getSubscribed($id){

        $pretplaceni = $this->belongsToMany('App\Kupac', 'kupac_slikar', 'slikar_id', 'kupac_id')->get();
        $ret = false;

        foreach ($pretplaceni as $korisnik){
            if($korisnik->user_id==$id){
                $ret = true;
            }
        }
        return $ret;
    }

}
