@extends('layouts.app')

@section('head')
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        var end = new Date('{{$endTime}}');
    </script>
    <link rel="stylesheet" href="/css/Matija.css">
    <script src="/js/Matija.js"></script>
    <script src="/js/timer.js"></script>

@endsection
{{--
@section('header_form')

    <a href="{{route('profile.info','id'=>Auth::id())}}" >
        <img src="{{$path}}" alt="AAAA" class="img-fluid float-right" style="padding-left: 20px">
    </a>
    <a href="/korpa">
        <img src="/images/design/cart.png" alt="BBBB" class="img-fluid float-right">
    </a>
@endsection--}}

@section('content')


    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="nazivSlike">
                        {{$picture->naziv}}
                    </div>
                    <img src="{{$picture->path}}" alt="" class="img-fluid" width="100%">
                    <div>
                        <table class="table table-borderless">
                            <tr>
                                <td class="detaljiSlike">
                                    Slikar:
                                </td>
                                <td class="detaljiSlike">
                                    {{$picture->autor}}
                                </td>
                            </tr>
                            <tr>
                                <td class="detaljiSlike">
                                    Stil:
                                </td>
                                <td class="detaljiSlike">
                                    {{$stil->naziv}}
                                </td>
                            </tr>
                            <tr>
                                <td class="detaljiSlike">
                                    Tema:
                                </td>
                                <td class="detaljiSlike">
                                    @foreach($teme as $tema)
                                        {{'#'.$tema->tema}}
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <br><br><br>
                    <div class="opisSlike">
                        {{$picture->opis}}
                    </div>
                    <br><br><br>
                    @yield('cenaIDugmici')
                </div>
            </div>
        </div>
        <div class="col-1">

        </div>
    </div>



@endsection
