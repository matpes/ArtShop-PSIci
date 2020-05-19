<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stil extends Model
{
    //
    protected $fillable=[
        'id', 'naziv'
    ];

    /**
     * funkcija koja dohvata sve slike sa tekucim stilom
     *
     * @return HasMany
     */
    public function pictures(){
        return $this->hasMany('App\Picture');
    }
}
