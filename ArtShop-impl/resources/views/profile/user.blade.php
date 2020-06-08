{{-- prikaz slideshow-a slika slikara koje kupac prati sa mogućnošću promene
    trenutne slike za jednu napred/nazadslika slikara koje kupac prati --}}
{{--!!!!!!!!!NEMA ŠTA ZA DOADTI!!!!!!!!!--}}
@extends('layouts.app')
@section('head')
    <script src="/js/Sanja.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/Sanja.css">
    <link rel="stylesheet" type="text/css" href="/css/Matija.css">
@endsection
@section('content')
    <div class="container">
        @if($user->isSlikar)
            <div class="alert alert-success" role="alert">
                {{ __('Nemate pravo pristupa ovoj stranici!') }}
            </div>
            <br> <br> <br>
            {{--     povratak na početnu     --}}
            <form method="GET" action="{{ route('profile.user_new', ['id'=>$user->id]) }}">
                <button type="submit" class="btn btn-warning">
                    {{ __('Povratak na početnu') }}
                </button>
            </form>
        @else
            <div class="row justify-content-center">
                <div class="col-md-12 justify-content-center">
                    <a class="btn btn-link offset-md-4" style="font-size: 25px; white-space: nowrap;"
                       href="{{  route('profile.user_new', [Auth::user()->id]) }}">
                        Najnovije
                    </a>
                    <p class="box ml-0" style="background-color: #02150f">
                        Praćenja
                    </p>
                    <br>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if(sizeof($slike) == 0)
                        <div class="alert alert-success" role="alert">
                            {{ __('Istražite galeriju najnovijih slika i zapratite nekog slikara!') }}
                        </div>
                    @else
                        @for($j = 0; $j < sizeof($slikariUsername); $j++)
                            {{$slikariUsername[$j]->username}}

                            <div id="carouselExampleIndicators{{$j}}" class="carousel slide" data-ride="carousel" style="height: 300px !important;">

                                <ol class="carousel-indicators noMargin">
                                    @for($i = 0; $i< count($slike[$j]); $i++)
                                        @if($i == 0)
                                            <li class="active" data-target="#carouselExampleIndicators{{$j}}"
                                                data-slide-to={{$i}}
                                            ></li>
                                        @else
                                            <li data-target="#carouselExampleIndicators{{$j}}"
                                                data-slide-to={{$i}}></li>
                                        @endif
                                    @endfor
                                </ol>

                                <div class="carousel-inner">
                                    @php($k = 0)
                                    @foreach($slike[$j] as $i)


                                        @if($k == 0)
                                            <div class="carousel-item active text-center" style="height: 300px !important; background-color: inherit !important;">
                                                <a href="/picture/{{$i->id}}">
                                                <img class="img-fluid active" src='{{$i->path}}'
                                                     alt="..." style="height: 300px !important;">
                                                </a>
                                        @else
                                             <div class="carousel-item text-center" style="height: 300px !important; background-color: inherit !important;">
                                                 <a href="/picture/{{$i->id}}">
                                                 <img class="img-fluid" src='{{$i->path}}' style="height: 300px !important;"
                                                  alt="...">
                                                 </a>
                                        @endif

                                        </div>


                                                    @php($k++)
                                    @endforeach
                                </div>

                                            <a class="carousel-control-prev" href="#carouselExampleIndicators{{$j}}"
                                               data-slide="prev">
                                                <span class="carousel-control-prev-icon"></span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators{{$j}}"
                                               data-slide="next">
                                                <span class="carousel-control-next-icon"></span>
                                            </a>
                                </div>

                                {{--                    <div class="slideshow-container">--}}
                                {{--                        @foreach($slike[$j] as $i)--}}
                                {{--                            <div class="mySlides mySlides{{$j}}" style="height: 250px !important;">--}}
                                {{--                                <img src="{{$i->path}}" class="slide-image img-fluid">--}}
                                {{--    --}}{{--                                 href="{{ route('slika',  ['id'=>$slike[$i]->id]) }}">--}}
                                {{--    --}}{{--                            <div class="text"><?php echo 'Naziv: ' . $slike[$j][$i]->naziv . 'Autor: ' . $slike[$i]->autor; ?></div>--}}
                                {{--                            </div>--}}
                                {{--                        @endforeach--}}
                                {{--                        <a class="prevM" onclick="plusSlidesFollowers(-1, {{$j}})" style="margin-left: 300px !important;">&#10094;</a>--}}
                                {{--                        <a class="nextM" onclick="plusSlidesFollowers(1, {{$j}})" style="margin-right: 300px !important;">&#10095;</a>--}}
                                {{--                    </div>--}}
                                @endfor
                                @endif
                            </div>
                </div>
                @endif
            </div>
    </div>
@endsection
@section('footer')
    @if(sizeof($slike) == 0)
        <footer>@endif
            <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid mb-1">
            @if(sizeof($slike) == 0)</footer>@endif
@endsection
