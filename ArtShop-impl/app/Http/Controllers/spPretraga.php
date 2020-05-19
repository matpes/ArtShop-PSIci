<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Stil;
use App\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Class spPretraga
 * @package App\Http\Controllers
 * @version 1.0
 * Klasa kontrolera za upravljanje pretragom slika
 */
class spPretraga extends Controller
{

    /**
     * Author: Pavićević Vladana 17/0296
     * --------------------------------------
     * spPretraga
     * --------------------------------------
     */


    /**
     * Prikaz rezultata pretrage
     *
     * @return View
     */
    public function index()
    {
        $pictures = [];
        if($_GET['tema'] != ""){
            $temas = Tema::where('tema', 'like', '%'.$_GET['tema'].'%')->get();
            foreach ($temas as $t){
                $tema = new Tema();
                $tema->id = $t->id;
                $tema->tema = $t->tema;
                $pics = $tema->pictures;
                foreach ($pics as $pic){
                    $p = new Picture();
                    $p->id = $pic->id;
                    $p->user_id = $pic->user_id;
                    $p->autor = $pic->autor;
                    $p->stil_id = $pic->stil_id;
                    $p->naziv = $pic->naziv;
                    $p->path =  $pic->path;
                    $p->smer = $pic->smer;
                    array_push($pictures, $p);
                }
            }
        }
        elseif($_GET['autor'] != ""){
            $pictures = Picture::where('autor', 'like', '%'.$_GET['autor'].'%')->get();

        }
        elseif ($_GET['stil'] != "stil"){
            $stils = Stil::all()->where('naziv', $_GET['stil']);
            foreach ($stils as $s){
                $stil = new Stil();
                $stil->id = $s->id;
                $stil->naziv = $s->naziv;
                $pics = $stil->pictures;
                foreach ($pics as $pic){
                    $p = new Picture();
                    $p->id = $pic->id;
                    $p->user_id = $pic->user_id;
                    $p->autor = $pic->autor;
                    $p->stil_id = $pic->stil_id;
                    $p->naziv = $pic->naziv;
                    $p->path =  $pic->path;
                    $p->smer = $pic->smer;
                    array_push($pictures, $p);
                }
            }
        }
        foreach ($pictures as $key => $picture){
            $flag = false;
            if($_GET['autor'] != "") {
                if(!preg_match('/'.$_GET['autor'].'/i', $picture->autor)){
                    $flag = true;
                }
            }
            if($_GET['stil'] != "stil"){
                $stils = Stil::all()->where('naziv', $_GET['stil']);

                foreach ($stils as $s){
                    if($picture->stil_id != $s->id){
                        $flag = true;
                    }
                }
            }
            if($flag == true){
                unset($pictures[$key]);
            }
        }
        return view('pretraga', compact('pictures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @deprecated
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @deprecated
     * @return void
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @deprecated
     * @return void
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @deprecated
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @deprecated
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @deprecated
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
