<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Slikar – model klasa za upravljanje tabelom slikars
 *
 * @version 1.0
 */
class Slikar extends Model
{
    //
    protected $fillable = [
        'user_id', 'sumaOcena', 'brOcenjenihSlika'
    ];

    protected $primaryKey ='user_id';

    /**
     * funkcija koja dohvata sve korisnike koji prate slikara
     *
     * @return BelongsToMany
     */
    public function subscribed(){
        return $this->belongsToMany('App\Kupac', 'kupac_slikar', 'slikar_id', 'kupac_id');
    }

    /**
     * funkcija koja dodaje kupca u pretplacene kupce za tekuceg slikara
     *
     * @param int $id - id kupca koji se pretplacuje na slikara
     *
     * @return void
     */
    public function dodajSubscribera($id){
        $this->belongsToMany('App\Kupac', 'kupac_slikar', 'slikar_id', 'kupac_id')->attach($id);

    }


    /**
     * funkcija koja proverava da li je kupac sa prosledjenim id-jem pretplacen na slikara
     *
     * @param int $id - id kupca koji za kog se vrsi provera
     *
     * @return boolean
     */
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
