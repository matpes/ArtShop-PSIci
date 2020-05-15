<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Stil;
use DateTime;
use Illuminate\Http\Request;

class spSlika extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $error = [];
        $picture = new Picture();
        return view('slika_form', compact('error', 'picture'));
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
        $flag = 0;
        $error = [];
        $aukcija = 0;
        $picture = new Picture();
        $picture->stil_id = Stil::where('naziv', $request->get('stil_id'))->get()[0]->id;
        $request->merge(['stil_id' => $picture->stil_id]);
        $picture->smer = $request->get('smer');

        if($request->get('path') == null){
            $flag = 1;
            $error['path'] = "***Morate izabrati sliku!***";
        }
        else{
            $picture->path = $request->get('path');
        }

        if($request->get('naziv') == null){
            $flag = 1;
            $error['naziv'] = "***Polje naziv je obavezno!***";
        }
        else{
            $picture->naziv = $request->get('naziv');
        }

        if($request->get('autor') == null){
            $flag = 1;
            $error['autor'] = "***Polje autor je obavezno!***";
        }
        else{
            $picture->autor = $request->get('autor');
        }

        if($request->get('opis') == null || strlen($request->get('opis')) < 10){
            $flag = 1;
            $error['opis'] = "***Opis mora imati bar 10 karaktera!***";
        }
        else{
            $picture->opis = $request->get('opis');
        }

        if($request->get('aukcijaFlag') != null){
            if($request->get('danIstekaAukcije') == null){
                $flag = 1;
                $error['danIstekaAukcije'] = "***Morate postaviti dan isteka aukcije!***";
            }
            else{
                $picture->danIstekaAukcije = new DateTime($request->get('danIstekaAukcije'));
                $request->merge(['danIstekaAukcije' => $picture->danIstekaAukcije]);
            }

            $aukcija = 2;
            if($request->get('aukcijaFlag') == 'javnaAukcija'){
                $aukcija = 1;
                if($request->get('cena') == null) {
                    $flag = 1;
                    $error['cena'] = "***Morate postaviti pocetnu cenu!***";
                }
                else{
                    $picture->cena = $request->get('cena');
                }
            }
        }
        else{
            if($request->get('cena') == null) {
                $flag = 1;
                $error['cena'] = "***Morate postaviti cenu!***";
            }
            else{
                $picture->cena = $request->get('cena');
            }
        }
        $picture->aukcijaFlag = $aukcija;
        $request->merge(['aukcijaFlag' => $aukcija]);
        if($flag == 1){
            return view('slika_form', compact('error', 'picture'));
        }
        else{
            $picture->korisnik_id = 6;
            if(count(Picture::where('path', $picture->path)->get()) == 0){
                $picture->save();
            }
            else{
                Picture::where('path', $picture->path)->get()[0]->update($request->all());
            }
        }
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
        $error = [];
        $picture = Picture::findOrFail($id);
        $picture->danIstekaAukcije = new DateTime($picture->danIstekaAukcije);
        return view('slika_form', compact('error', 'picture'));
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
        $picture = Picture::findOrFail($id);
        $picture->delete();
    }
}
