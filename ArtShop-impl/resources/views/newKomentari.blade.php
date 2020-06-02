@extends('layouts.app')

@section('head')
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/Ana.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script type="text/javascript">

        function simulirajKlik() {

            document.getElementById('btnDelete').click();

            //simulateClick(document.getElementById('btnDelete'));

        }

    </script>
@endsection
@section('content')

{{--<h1> Komentari, guys:::</h1>--}}

<?php
    if(isset($_GET['submit']))
        $komentarToDelete_id = $_GET['name'];

    $autori->toArray();
    $i=-1;
?>
@foreach($sviKomentari as $komentar)
  <?php $i++; $autor=$autori[$i]?>
  <div class="row">
      <div class="offset-sm-1 col-sm-6">
          <!--Ime autora-->
          <div class="user_name">
              {{$autor->username}}
          </div>
          <div>
              <!--Komentar-->
              <div class="tekst_komentara">
                  {{$komentar->tekst}}
              </div>
              <div>
                 <!--Ako je trenutni user napisao trenutni komentar dugme obrisi, ako nije dugme prijavi-->
                 @if($autor->id==Auth::id())
                    {{-- Brisanje button --}}
                     <button class="btn btn-warning" type="button"{{-- id ="btnDelete"--}} name="isSubmit"
                             data-toggle="modal" data-target="#obrisi_komentar">{{__('Obriši komentar')}}
                     </button>
                 @else
                     <form method="get" action="{{ route('comment.report') }}">
                         <input type="hidden" name="komentar_id" value="{{ $komentar->id }}">
                         <button type="submit" class="btn btn-warning">
                             {{ __('Prijavi komentar') }}
                         </button>
                     </form>
                 @endif
              </div>
          </div>
          <br>
      </div>
  </div>
@endforeach



<!--Povratak na stranicu sa slikama-->

    <a class="btn btn-link-btn" href="/picture/{{$picture_id}}">
        <button type="button" class="btn btn-warning">
            {{ __('Nazad na sliku') }}
        </button>
    </a>

<!--dugme za unos komentara-->

<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#unosKomentara">
    {{ __('Napiši komentar') }}
</button>

<!--
//data-toggle="modal" data-target="#myModal"
//TO DO Nazvati formu pa dohvatati preko forme kao sto smo radili na vdu najobicnije
//TO DO Pozvati posebnu funkciju komtrolera koja ce prodledjivati odgovarajuci id ovom vjuu i onda ponovo ucitavati stranicu
-->

<!--BRISANJE komentara modal-->
<div class="container-fluid">
    <div class="modal" id="obrisi_komentar" style="margin-top:15%;color:black;">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:rgb(64,64,64);color:#7FF000">
                <div class="modal-header">
                    <h5 style="font-size:20px">Da li ste sigurni da želite da obrisete ovaj komentar?</h5>
                </div>
                <div class="modal-body"><form method="post" action="{{ route('comment.delete') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <input type="hidden" name="picture_id" value="{{ $picture_id }}">
                        <input type="hidden" name="komentar_id" value="{{ $komentar->id }}">
                        <button type="submit" class="btn btn-warning">{{ __('Potvrdi') }}</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Odustani') }}</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Brisanje komentara</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end BRISANJE komentara modal-->


<!--modal za UNOS komentara-->
<div class="container-fluid">
    <div class="modal" id="unosKomentara" style="margin-top:15%;color:black;">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:rgb(64,64,64);color:#7FF000">
                <div class="modal-header">
                    <h5 style="font-size:20px">Unesite komentara</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('comment.post') }}">
                        <textarea rows="4" cols="35"  name="tekst" placeholder="Unesite komentar..."></textarea>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <input type="hidden" name="picture_id" value="{{$picture_id}}">
                        <button type="submit" class="btn btn-warning">{{ __('Potvrdi') }}</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Odustani') }}</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Unos komentar</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--END modal za UNOS komentara-->


<!--<form method="get" action="/postComment">
    <textarea name="tekst" placeholder="Enter your comment..."></textarea>
    {{ csrf_field() }}

    <input type="hidden" name="picture_id" value="{{$picture_id}}">
    <input type="submit" name="submit"  value="Objavi komentar" onclick="return confirm('Sure?')">
</form>-->



@endsection
