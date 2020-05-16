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
        return $this->hasMany('App\Kupac');
    }

}
