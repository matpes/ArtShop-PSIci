@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/css/Ana.css">
@endsection



@section('content')
    <div class="row justify-content-center noPadding">
        {{-- 1. kolona--}}
        <div class="col-md-4 mb-0 ml-0 text-md-left noPadding">
            {{--     profilna     --}}
            <div class="col-md-12 text-md-left mt-3">Profilna slika: &emsp;
                <img id='profilna' class="img-fluid " style="" width="140px" height="140px" alt="profilna_slika"
                     src= <?php if (is_null($user->picture_path)) {
                    echo '\images/avatar.png';
                } else {
                    $path = '\images\users\\' . $user->picture_path;
                    echo $path;
                } ?>>
            </div>
            <br>
            {{--     email     --}}
            <div class="col-md-12 text-md-left">E-mail: &emsp; {{__($user->email)}}</div>
            <br>
            {{--     username     --}}
            <div class="col-md-12 text-md-left">Korisničko ime: &emsp; {{__($user->username)}}</div>
            <br>
            {{--     tip naloga     --}}
            <div class="col-md-12 text-md-left">Tip naloga: &emsp;
                KUPAC
            </div>
            <br>
            {{--     prosečna ocena     --}}
            <div class="col-md-12 text-md-left">Broj prijava: &emsp;


                {{$user->brPrijava}}
            </div>
            <br>
            {{--     broj ocena     --}}
            <div class="col-md-12 text-md-left">Broj uspešnih prijava: &emsp;
                {{$user->brUspesnihPrijava}}
            </div>
            <br>
            <div>
                <form method="get" action="/nalozi/block/{{$user->id}}">
                    <button class="dugme" type="submit" style="width: 100%">Blokiraj nalog</button>
                </form>
            </div>
        </div>
    </div>
@endsection

