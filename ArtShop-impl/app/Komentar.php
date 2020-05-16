<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    //
    protected $fillable = [
        'user_id', 'picture_id', 'tekst', 'vreme'
    ];
}
