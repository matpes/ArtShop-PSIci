<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class spKomentari extends Controller
{
    //


    public function index(Request $request){ //iz requesta se dobija picture_id, a user_id dobijam preko AUTH



       // $komentars=Komentar::all(); //dohvatili sve komentare iz baze u kolekciju $komentars

        //compact--> every name from the record which is arguments transforms into variable :)

        return view ('komentari');
    }






}
