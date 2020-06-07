@extends('pictureBase')



@section('cenaIDugmici')

    <div class="opisSlike pozicijaDugmadiSlika">
        <form action="{{$picture->id}}/edit" method="get" class="form-group">
            <span class="cenaText">Trenutna cena:</span>
            <label for="" class="cenaLable">{{$picture->cena}}</label>
            <label for="mojaCena" class="cenaText">$</label>
            <br>
            <label for="mojaCena" class="cenaText">Moja cena:</label>
            <input type="text" name="mojaCena" id="mojaCena" class="form-control form_input_text cenaInputText" value="{{$picture->cena + 10}}">
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
            <span class="cenaText">Aukcija traje još:</span>
            <label for="" class="cenaLable" id="trajanje"></label>
        </form>

    </div>


@endsection
