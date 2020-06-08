@extends('.layouts.app')

@section('head')
    <link rel="stylesheet" href="/css/Ana.css">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
            <div class="alert alert-success text-center" role="alert">
                {{ __('Pogledajte korisničke naloge') }}
            </div>
    <form method="get" action="/nalozi/show">
    <button class ="dugmeAdminNalog" type="submit">Korisnicki nalozi</button>
    </form>

    </div>

    <div class="col-sm-6 text-center">
        <div class="alert alert-success text-center" role="alert">
            {{ __('Pogledajte prijave') }}
        </div>
    <form method="get" action="/prijave/show">
        <button class="dugmeAdminNalog" type="submit">Pogledaj prijave</button>
    </form>
    </div>
    </div>
@endsection
