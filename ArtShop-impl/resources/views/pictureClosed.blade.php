@extends('pictureBase')


@section('cenaIDugmici')

    <div class="opisSlike pozicijaDugmadiSlika">
        <form action="{{$picture->id}}/edit" method="get" class="form-group">

            <label for="mojaCena" class="cenaText">Moja cena:</label>
            <input type="text" name="mojaCena" id="mojaCena" class="form-control form_input_text cenaInputText">
            <label for="mojaCena" class="cenaText">$</label>
            <input type="hidden" name="id" value="{{$picture->id}}">
            {{csrf_field()}}
            <input type="submit" name="ubaciUKorpu" value="PONUDI" class="form-control dugmiciSlika btn-dark">
            <br>
            <input type="button" name="komentari" value="KOMENTARI" class="form-control dugmiciSlika btn-dark">
            <span class="cenaText">Aukcija traje još:</span>
            <label for="" class="cenaLable" id="trajanje"></label>
        </form>

    </div>


@endsection
