<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stil extends Model
{
    //
    protected $fillable=[
        'id', 'naziv'
    ];

    public function pictures(){
        return $this->hasMany('App\Picture');
    }
}
