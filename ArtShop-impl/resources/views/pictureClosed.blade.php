@extends('pictureBase')


@section('cenaIDugmici')

    <div class="opisSlike pozicijaDugmadiSlika">
        <form action="{{$picture->id}}/edit" method="get" class="form-group">

            <label for="mojaCena" class="cenaText">Moja cena:</label>
            <input type="text" name="mojaCena" id="mojaCena" class="form-control form_input_text cenaInputText">
            <label for="mojaCena" class="cenaText">$</label>
            <input type="hidden" name="id" value="{{$picture->id}}">
            {{csrf_field()}}
            @if($bought)
                <input disabled type="submit" name="ponudi" value="PONUDI"
                       class="form-control  kuplenoDugmic">
            @else
                <input type="submit" name="ponudi" value="PONUDI"
                       class="form-control dugmiciSlika btn-dark">
            @endif
        </form>
        <form action="">
            <input type="button" name="komentari" value="KOMENTARI" class="form-control dugmiciSlika btn-dark">
            {{csrf_field()}}
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
            <span class="cenaText">Aukcija traje još:</span>
            <label for="" class="cenaLable" id="trajanje"></label>
        </form>
            <span class="cenaText">Aukcija traje još:</span>
            <label for="" class="cenaLable" id="trajanje"></label>


    </div>


@endsection
