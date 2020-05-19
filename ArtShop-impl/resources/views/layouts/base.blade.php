@extends('layouts.app')
@section('head')
    <script src="/js/Sanja.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/Sanja.css">
@endsection

@section('content')
<div class="container mt-0" onload="showSlides(0)">
    <div class="row justify-content-center">
        <div class="col-md-2 offset-md-10 justify-content-center">
            <div class="box">
                Najnovije
            @if(Auth::check())
                <a class="box btn btn-link offset-md-4 col-md-1" href="{{  route('profile.user', [Auth::user()->id]) }}">
                    Praćenja
                </a>
            @endif
                <br>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center mb-3 mt-4">
            <div class="slideshow-container">
                @for($i=0;$i<sizeof($novo);$i++)
                    <div class="mySlides">
                        <div class="numbertext"><?php $p = ($i + 1) . ' / ' . sizeof($novo); echo $p; ?></div>
                        <img src="<?php echo $novo[$i]->path; ?>" width="100%" height="550px"
                             {{-- link do aukcije
                             href="{{ route('slika',  ['id'=>$novo[$i]->id]) }}" --}}
                            alt="<?php echo $novo[$i]->opis; ?>">
                        <div class="text">{{__($novo[$i]->naziv)}}</div>
                    </div>
                @endfor
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
@endsection

