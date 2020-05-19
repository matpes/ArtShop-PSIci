<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tema extends Model
{
    //
    protected $fillable=[
        'id', 'tema'
    ];

    /**
     * funkcija koja dohvata sve slike sa tekucom temom
     *
     * @return BelongsToMany
     */
    public function pictures(){
        return $this->belongsToMany('App\Picture');
    }
}
