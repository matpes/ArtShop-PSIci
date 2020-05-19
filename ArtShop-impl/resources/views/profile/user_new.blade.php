@extends('layouts.app')
@section('head')

    <script src="/js/Sanja.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/Sanja.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center">
            <p class="box offset-md-4" style="background-color: #02150f">
                Najnovije
            </p>
            <a class="btn btn-link ml-0" style="font-size: 25px; white-space: nowrap;"
                   href="{{  route('profile.user', [Auth::user()->id]) }}">
                Praćenja
            </a>
            <br>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="slideshow-container">
            @for($i=0;$i<sizeof($slike);$i++)
                    <div class="mySlides fade">
                        <div class="numbertext"><?php $p = $i . ' / ' . sizeof($slike); echo $p; ?></div>
                        <img src="<?php echo $slike[$i]->path; ?>" style="width:100%"
                             href="{{ route('login',  ['id'=>$slike[$i]->id]) }}">
                        <div class="text"><?php echo 'Naziv: ' . $slike[$i]->naziv . 'Autor: ' . $slike[$i]->autor; ?></div>
                    </div>
            @endfor
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
         </div>
    </div>
</div>
</div>
@endsection
@section('footer')
    <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
@endsection()
