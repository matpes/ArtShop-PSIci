

@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/Ana.css">
@endsection
@section('content')

    <?php
    //sekcija sa prijavama


    echo "<br><br>Prijave::<br><br><br>";

    $imenaAutora->toArray();
    $pictures->toArray();
    $autoriKomentara->toArray();
    $i=-1;





    foreach($prijave as $prijava){
        $i++;
        $autor=$imenaAutora[$i];
        $picture=$pictures[$i];
        $autorKomentara=$autoriKomentara[$i];
        echo '<h6><div clas="">Korisnik   '.$autor->username.'</div> je prijavio komentar korisnika <div class="">'.$autorKomentara->username.'</h6><form method="get" action="/prijavljenKomentar">
                                              <input type="hidden" name="prijava_id" value="'.$prijava->id.'">

                                              <input type="submit" class="dugme" name="submit" value="Pogledaj Komentar">
                                           </form>';


    }



    ?>





@endsection




