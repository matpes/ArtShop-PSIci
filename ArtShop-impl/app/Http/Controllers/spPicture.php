<?php

namespace App\Http\Controllers;

use App\Korpa;
use App\Kupac;
use App\Mail\newOffer;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\Console\Input\Input;

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
     * @param \Illuminate\Http\Request $request
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $korid = Auth::user();
        $picture = Picture::withTrashed()->find($id);
        $teme = $picture->teme();
        $slikar = Picture::dohvatiAutora($picture);
        $stil = Picture::dohvatiStil($picture);
        $endTime = $picture->danIstekaAukcije;
        $bought = false;
        $subscribed = false;
        if ($picture->deleted_at != null) {
            $bought = true;
        }
        if($korid->isSlikar==1){
            $bought = true;
            $subscribed = true;
        }
        if($korid->isSlikar==0){
            $subscribed = $slikar->getSubscribed($korid->id);
        }
        //dd($subscribed);
        switch ($picture->aukcijaFlag) {
            case 0:
                return view('.pictureSimple', compact('picture', 'slikar', 'stil', 'teme', 'endTime', 'bought', 'subscribed'));
                break;
            case 1:
                return view('.pictureOpen', compact('picture', 'slikar', 'stil', 'teme', 'endTime', 'bought', 'subscribed'));
                break;
            default:
                return view('.pictureClosed', compact('picture', 'slikar', 'stil', 'teme', 'endTime', 'bought', 'subscribed'));
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $korid = Auth::id();
        //dd($korid);
        $picture = Picture::find($id);
        //dd($picture->getUcesnika($korid));

        switch ($picture->aukcijaFlag) {
            case 0:
                $korpa = new Korpa;
                $korpa->user_id = $korid;
                $korpa->picture_id = $id;
                $korpa->save();
                Picture::find($id)->delete();
                break;
            case 1:
            case 2:
            default:
                $mojaCena = $_GET['mojaCena'];
                $ucesnik = $picture->getUcesnika($korid);
                $picture->cena = $mojaCena;
                $picture->save();
                $omg = $ucesnik->get();
                echo count($omg);
                if (count($omg) == 0) {
                    $ucesnik->attach($korid, ['cena' => $mojaCena]);
                } else {
                    foreach ($ucesnik as $uc) {
                        $ucesnik->updateExistingPivot($korid, ['cena' => $mojaCena]);
                    }
                }
                $korisnici = $picture->getSveUcesnike();
                foreach ($korisnici as $korisnik) {
                    if ($korisnik->id != $korid) {
                        Mail::to($korisnik->email)->send(new newOffer($picture));
                    }
                }
                //spMail::newOffer($picture, $korid);
                break;
        }

        return redirect('picture/' . $id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo 'DESTROYED';
    }
}
