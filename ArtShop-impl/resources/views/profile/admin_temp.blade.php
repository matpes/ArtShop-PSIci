@extends('.layouts.app')

@section('content')
    <form method="get" action="/nalozi/show">
    <button type="submit">Korisnicki nalozi</button>
    </form>


    <form method="get" action="/prijave/show">
        <button type="submit">Pogledaj prijave</button>
    </form>
@endsection
