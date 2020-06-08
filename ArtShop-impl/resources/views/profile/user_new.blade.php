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
{{--                @for($i=0;$i<sizeof($novo);$i++)--}}
                    @php($i=1)
                    @foreach($novo as $nov)
                    <div class="mySlides" style="height: 400px !important;">
                        <div class="numbertext"><?php $p = ($i) . ' / ' . sizeof($novo); echo $p; ?></div>
                        <a href="/picture/{{$nov->id}}">
                        <img src="<?php echo $nov->path; ?>" class="slide-image"
                             {{-- link do aukcije
                             href="{{ route('slika',  ['id'=>$novo[$i]->id]) }}" --}}
                             alt="<?php echo $nov->opis; ?>">
                        </a>
                        <div class="text">{{__($nov->naziv)}}</div>
                    </div>
                        @php($i++)
                    @endforeach
{{--                @endfor--}}
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
