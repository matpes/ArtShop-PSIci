{{-- prikaz slideshow-om 5 najnovijih slika sa mogućnošću promene trenutne
    slike za jednu napred/nazad --}}

{{--!!!!!!!!! DOADTI LINK DO AUKCIJE! !!!!!!!!!!--}}
@extends('layouts.app')
@section('head')

    <script src="/js/Sanja.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/Sanja.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center">
            <p class="box offset-md-5" style="background-color: #02150f">
                Najnovije
            </p>
            @if(!$user->isSlikar)
            <a class="btn btn-link ml-0" style="font-size: 25px; white-space: nowrap;"
                   href="{{  route('profile.user', [Auth::user()->id]) }}">
                Praćenja
            </a>
            @endif
            <br>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(sizeof($novo) == 0)
                <div class="alert alert-success" role="alert">
                    {{ __('Nema novih slika!') }}
                </div>
            @else
            <div class="slideshow-container">
                @for($i=0;$i<sizeof($novo);$i++)
                    <div class="mySlides">
                        <div class="numbertext"><?php $p = ($i + 1) . ' / ' . sizeof($novo); echo $p; ?></div>
                        <img src="<?php echo $novo[$i]->path; ?>" class="slide-image"
                             {{-- link do aukcije
                             href="{{ route('slika',  ['id'=>$novo[$i]->id]) }}" --}}
                             alt="<?php echo $novo[$i]->opis; ?>">
                        <div class="text">{{__($novo[$i]->naziv)}}</div>
                    </div>
                @endfor
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            @endif
         </div>
    </div>
</div>
</div>
@endsection
@section('footer')
    @if(sizeof($novo) == 0)<footer>@endif
    <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    @if(sizeof($novo) == 0)</footer>@endif
@endsection()
