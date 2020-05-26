@extends('pictureBase')


@section('cenaIDugmici')

    <div class="opisSlike pozicijaDugmadiSlika">


        <form action="{{$picture->id}}/edit" method="get" class="form-group">
            {{--                <input type="hidden" name="_method" value="POST">--}}
            <label for="mojaCena" class="cenaText">Cena:</label>
            <label for="" class="cenaLable">{{$picture->cena}}</label>
            <label for="mojaCena" class="cenaText">$</label>
            {{csrf_field()}}
            @if($bought)

                <input disabled type="submit" name="ubaciUKorpu" value="UBACI U KORPU"
                       class="form-control  kuplenoDugmic">
            @else
                <input type="submit" name="ubaciUKorpu" value="UBACI U KORPU"
                       class="form-control dugmiciSlika btn-dark">
            @endif

        </form>

        <form action="/comments" method="get">
            <input type="hidden" name="picture_id" value="{{$picture->id}}">
            <input type="submit" name="komentari" value="KOMENTARI" class="form-control dugmiciSlika btn-dark">
        </form>
        <form action="/subscribe" method="post">
            <input type="hidden" name="slikar" value="{{$picture->user_id}}">
            <input type="hidden" name="picture" value="{{$picture->id}}">
            {{csrf_field()}}
            @if($subscribed)
                <input disabled type="submit" name="prijava" value="SUBSCRIBE" class="form-control kuplenoDugmic">
            @else
                <input type="submit" name="prijava" value="SUBSCRIBE" class="form-control dugmiciSlika btn-dark">
            @endif
        </form>

    </div>


@endsection
