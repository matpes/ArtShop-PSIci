<?php

namespace App\Http\Controllers;

use App\Korpa;
use App\Kupac;
use App\Mail\newOffer;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\Console\Input\Input;

/**
 * Class spPicture
 * @package App\Http\Controllers
 * Klasa kontrolera za upravljanje slikama
 */
class spPicture extends Controller
{
    /**
     * Author: Pešić Matija 17/0428
     * Author: Pavićević Vladana 17/0296
     * --------------------------------------
     * spPicture
     * --------------------------------------
     */


    /**
     * Display a listing of the resource.
     *
     * @deprecated
     * @return void
     */
    public function index()
    {
        //
        echo 'INDEX';
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
        echo 'CREATED';
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return string
     *@deprecated
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
     * @return View
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
        $kupac = Auth::user();
        $path = '/images/avatar.png';
        if($kupac->profilna_slika!=null){
            $path = '/images/users//'.$kupac->profilna_slika;
        }
        //dd($subscribed);
        switch ($picture->aukcijaFlag) {
            case 0:
                return view('.pictureSimple', compact('path', 'picture', 'slikar', 'stil', 'teme', 'endTime', 'bought', 'subscribed'));
                break;
            case 1:
                return view('.pictureOpen', compact('path','picture', 'slikar', 'stil', 'teme', 'endTime', 'bought', 'subscribed'));
                break;
            default:
                return view('.pictureClosed', compact('path','picture', 'slikar', 'stil', 'teme', 'endTime', 'bought', 'subscribed'));
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Redirector
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
                if($mojaCena > $picture->cena) {
                    $picture->cena = $mojaCena;
                }
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
     * @param Request $request
     * @param int $id
     * @return void
     *@deprecated
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
     * @deprecated
     * @return void
     */
    public function destroy($id)
    {
        //
        echo 'DESTROYED';
    }
}
