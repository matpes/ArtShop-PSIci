

@extends('layouts.app')

@section('content')

    <?php
    //sekcija sa prijavama


    echo "Prijave::";

    $imenaAutora->toArray();
    $pictures->toArray();
    $i=-1;





    foreach($prijave as $prijava){
        $i++;
        $autor=$imenaAutora[$i];
        $picture=$pictures[$i];
        echo '<h6>'.$autor->username."      ".$prijava->komentar_id.'</h6><form method="get" action="/prijavljenKomentar">
                                              <input type="hidden" name="prijava_id" value="'.$prijava->id.'">

                                              <input type="submit" name="submit" value="Pogledaj Komentar">
                                           </form>';


    }



    ?>





@endsection




