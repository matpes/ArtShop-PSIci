<?php

namespace App\Http\Controllers;

use App\Korpa;
use App\Picture;
use Illuminate\Http\Request;

class spPicture extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo 'INDEX';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo 'CREATED';
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
        echo 'STORED';
        return "OK";
    }

    /**
     * Prikazivanje slike sa zadatim ID-jem
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $picture = Picture::withTrashed()->find($id);

        $slikar = Picture::dohvatiAutora($picture);
        $stil = Picture::dohvatiStil($picture);
        $teme = ['jedna', 'druga'];
        $endTime = $picture->danIstekaAukcije;
        $bought = false;
        if($picture->deleted_at != null){
            $bought = true;
        }
        switch ($picture->aukcijaFlag){
            case 0:
                return view('.pictureSimple', compact('picture', 'slikar', 'stil', 'teme', 'endTime', 'bought'));
                break;
            case 1:
                return view('.pictureOpen', compact('picture', 'slikar', 'stil', 'teme', 'endTime'));
                break;
            default:
                return view('.pictureClosed', compact('picture', 'slikar', 'stil', 'teme', 'endTime'));
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $korpa = new Korpa;
        $korpa->korisnik_id = 1;
        $korpa->picture_id = $id;
        $korpa->save();
        Picture::find($id)->delete();
        return redirect('picture/'.$id);

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
        echo 'UPDATED';
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
        echo 'DESTROYED';
    }
}
