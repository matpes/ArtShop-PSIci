<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('GuestMiddleware');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    /**
     *
     * Show the application welcome.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja dohvata 5 njanovijih slika
     *
     * @param
     * @return Response
     */
    public function popularPictures()
    {
        $user = Auth::user();
        //dovlacenje popularnih slika u $popular
        $popular = null;

        $popular = Picture::all()->sortByDesc('created_at')->take(5);

        return response()->view('layouts.base', ['$user'=>$user, 'novo'=>$popular]);
    }
}
