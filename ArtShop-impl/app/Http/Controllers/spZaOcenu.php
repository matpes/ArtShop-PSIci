<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Picture;
use App\Slikar;
use App\ZaOcenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class spZaOcenu extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slikeZaOcenu = ZaOcenu::zaOcenu(Auth::id());
        $autori = Picture::dohvatiAutoreSlika($slikeZaOcenu);
        return view('.ocene', compact('autori', 'slikeZaOcenu'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        $count = $request->numberOfPics;
        for($i = 0; $i<$count; $i++){
            //echo $i;
            $str = 'pic'.$i;
            $id = $request->$str;
            if($request->$id > 0) {
                $slika = Picture::onlyTrashed()->find($id);
                $slikar = Slikar::find($slika->user_id);
                $slikar->brOcenjenihSlika++;
                $slikar->sumaOcena += $request->$id;
                $slikar->save();
                ZaOcenu::destroy($id);

            }
        }
        return redirect('/zaOcenu');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
