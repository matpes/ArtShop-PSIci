@extends('welcome')

@section('head')
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Matija.css">
    <script src="/js/Matija.js"></script>
    <script src="/js/Zvezdice.js"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            @if(count($slikeZaOcenu)>0)
            @for($i = 0; $i < count($slikeZaOcenu); $i++)

                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <img src="{{$slikeZaOcenu[$i]->path}}" alt="" class="img-fluid" width="100%">
                    </div>
                    <div class="col-sm-12 col-md-9">

                        <div style="color:white;">
                            <i class="fa fa-star fa-2x" data-index="{{$i}}0"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}1"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}2"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}3"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}4"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}5"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}6"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}7"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}8"></i>
                            <i class="fa fa-star fa-2x" data-index="{{$i}}9"></i>
                            <br>
                        </div>
                        <br>
                        <div class="dark_background korpa_kratak_opis">
                            &emsp;Slika: <br>
                            &emsp;&emsp; {{$slikeZaOcenu[$i]->naziv}} <br>
                            &emsp;Slikar: <br>
                            &emsp;&emsp; {{$autori[$i]->username}} <br>
                        </div>
                    </div>
                </div>
                <br>
                <br>
            @endfor

            <form action="zaOcenu" method="post">
                <input type="submit" value="Zavrsi" class="btn-dark gray_button zavrsiButton">
                {{csrf_field()}}
                @for($i = 0; $i < count($slikeZaOcenu); $i++)
                    <input type="hidden" name="pic{{$i}}" value="{{$slikeZaOcenu[$i]->id}}">
                    <input type="hidden" name="{{$slikeZaOcenu[$i]->id}}" id="pic{{$i}}" value="0">
                @endfor
                <input type="hidden" name="numberOfPics" value="{{count($slikeZaOcenu)}}">
            </form>
            @else
                <div class="row">
                    <div class="offset-3 col-6">
                        <div class="emptyCart" style="padding: 150px">
                            Nemate slika za ocenjivanje
                        </div>
                    </div>
                </div>
            @endif
            <br><br><br><br><br>
        </div>
        <div class="col-1">

        </div>
    </div>







@endsection
