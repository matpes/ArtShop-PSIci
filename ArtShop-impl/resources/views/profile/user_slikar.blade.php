{{--prikazuje profil slikara sa svi slikama koje je objavio--}}
{{--!!!!!!!!!!!!!!!!!!!DODATI PUTANJU DO OBJAVI SLIKU!!!!!!!!!!!!!!--}}
@extends('layouts.app')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script>
        var cnt = 0;
        function go(n,br) {
            cnt = cnt + n;
            if(cnt >= br){
                cnt = 0;
            } else if(cnt < 0){
                cnt = br - 1;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/profile/user_slikar',
                data:{cnt:cnt, br:br},
                success:function(data) {
                    $("#pic").attr("src",data.path);
                    $("#pic").attr("alt",data.naziv);
                    $("#naziv").html(data.naziv);
                    $("#stil").html(data.stil);
                    $("#tema").html(data.tema);
                    $("#nacin").html(data.nacin);
                    $("#opis").html(data.opis);
                    $("#cena").html(data.cena);
                    $("#num").html(data.num);
                }
            });
        }
    </script>
    <link rel="stylesheet" type="text/css" href="/css/Sanja.css">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(is_null($novo))
                <div class="col-md-12 justify-content-center" >
                    <div class="alert alert-success mt-5 text-center" role="alert">
                        {{ __('Nemate slika! Kada objavite sliku ovde će se prikazati.') }}
                    </div>
                    <br> <br> <br>
                    {{--     nazad na početnu     --}}
                    <form method="GET" action="{{ route('profile.user_new', ['id'=>$user->id]) }}" class="offset-md-5">
                        <button type="submit" class="btn btn-warning offset-md-5">
                            {{ __('Nazad na početnu') }}
                        </button>
                    </form>
                </div>
            @else
            {{-- 1. kolona--}}
            <div class="col-md-6 justify-content-center">
                <div class="gray_title" id="naziv"> {{__($novo->naziv)}} </div>
                <br>
                <div class="slideshow-container mt-2">
                    <div class="myPics" style="display: block;">
                        <div class="numbertext" id="num"><?php echo $cnt + 1;?> / <?php echo $br;?></div>
                        <img src="<?php echo $novo->path; ?>" class="my-slide-image"
                             id = "pic" alt="<?php echo $novo->naziv; ?>">
                    </div>
                </div>
            </div>
            {{-- 2. kolona--}}
            <div class="col-md-6 justify-content-center">
                <div class="title-opis"> Opis: </div>
                <br>
                <div id="opis"> <?php echo $novo->opis; ?></div>
                <br>
                <div class="custom-control-inline">
                    <label class="text-md-left" for="cena"> Cena: &nbsp; </label>
                    <div class="text-md-left" id="cena"><?php echo $novo->cena;?></div> <div>&nbsp; RSD</div>
                </div>
                <br> <br>
                <button type="button" class="btn-dark gray_button mb-5" onclick="go(-1, <?php echo $br;?>)"
                        style="width: fit-content;">
                    {{ __('Nazad') }}
                </button>
                <button type="button" class="btn-dark gray_button mb-5" onclick="go(1, <?php echo $br;?>)"
                        style="width: fit-content;">
                    {{ __('Napred') }}
                </button>
                <br>
                <div>
                    <div class="custom-control-inline">
                        <label class="text-md-left" for="nacin">Način prodaje: &nbsp; </label>
                        <div class="text-md-left" id="nacin">@if($novo->aukcijaFlag) aukcija @else prvom kupcu @endif</div>
                    </div>
                    <br>
                    <div class="custom-control-inline">
                        <label class="text-md-left" for="stil">Stil: &nbsp; </label>
                        <div class="text-md-left" id="stil"><?php echo $stil->naziv; ?></div>
                    </div>
                    <br>
                    <div class="custom-control-inline">
                        <label class="text-md-left" for="tema">Tema: &nbsp;</label>
                        <div class="text-md-left" id="tema">
                            @foreach($tema as $t)
                                <?php echo $t->tema. ' &emsp; '; ?>
                            @endforeach
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
@section('footer')
    @if(is_null($novo)) <footer> @endif
        <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
        @if(is_null($novo))</footer> @endif
@endsection
