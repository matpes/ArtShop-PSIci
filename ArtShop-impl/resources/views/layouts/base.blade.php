{{-- početna sa auto slideshow-om 5 najnovijih slika sa mogućnošću promene
    trenutne slike za jednu napred/nazad --}}
@extends('layouts.app')
@section('head')
    <script src="/js/Sanja.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/Sanja.css">
@endsection
@section('content')
    <div class="container mt-0" onload="showSlides(0)">
        <div class="row justify-content-center">
            <div class="justify-content-center">
                <div class="box"> Najnovije </div>
                <br>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 justify-content-center mb-3 mt-4">
                @if(sizeof($novo) == 0)
                    <div class="alert alert-success" role="alert">
                        {{ __('Nema novih slika!') }}
                    </div>
                @else
                    <div class="slideshow-container">
                        @php($i=1)
                        @foreach($novo as $nov)
                            <div class="mySlides" style="height: 400px !important;">
                                <div class="numbertext"><?php $p = ($i) . ' / ' . sizeof($novo); echo $p; ?></div>
                                <a href="/picture/{{$nov->id}}">
                                    <img src="{{$nov->path}}" class="slide-image"
                                         {{-- link do aukcije
                                         href="{{ route('slika',  ['id'=>$novo[$i]->id]) }}" --}}
                                         alt="{{$nov->opis}}">
                                </a>
                                <div class="text">{{__($nov->naziv)}}</div>
                            </div>
                            @php($i++)
                        @endforeach
                    </div>
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
@endsection

