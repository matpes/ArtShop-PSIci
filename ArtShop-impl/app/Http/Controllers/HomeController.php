<?php

namespace App\Http\Controllers;

use App\Picture;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
     * Author: Sanja Samardžija 17/0372
     * Show the application welcome.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Author: Sanja Samardžija 17/0372
     * Show the application startpage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function app()
    {
        return view('layouts.app');
    }

    /**
     *  Author: Samardžija Sanja 17/0372
     * Funkcija koja dohvata 5 najpopularnijih slika
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function popularPictures()
    {
        $user = Auth::user();
        //dovlacenje popularnih slika u $popular
        $popular = null;

        $popular = Picture::all()->sortByDesc('created_at')->take(5)->get();

        return response()->view('layouts.base', ['popular'=>$popular]);
    }
}
