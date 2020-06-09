@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/Ana.css">
@endsection
@section('content')

    <div class="row">

        <div class="offset-sm-2 col-sm-9">


            <?php
            //sekcija sa prijavama


            echo "<br><h3>Prijave::</h3><br>";

            $imenaAutora->toArray();
            $pictures->toArray();
            $autoriKomentara->toArray();
            $i = -1;





            foreach ($prijave as $prijava) {
                $i++;
                $autor = $imenaAutora[$i];
                $picture = $pictures[$i];
                $autorKomentara = $autoriKomentara[$i];
                echo '<h6><div clas="">Korisnik   ' . $autor->username . '</div> je prijavio komentar korisnika <div class="">' . $autorKomentara->username . '</h6>
                                            <form method="get" action="/prijavljenKomentar" style="display: inline">
                                              <input type="hidden" name="prijava_id" value="' . $prijava->id . '">

                                              <input type="submit" class="dugme" name="submit" value="Pogledaj Komentar">
                                           </form>

<!--dodatak nrisanje prijave-->
                                              <form method="get" action="/brisanjePrijave" style="display: inline">
                                              <input type="hidden" name="prijava_id" value="' . $prijava->id . '">
                                              <input type="submit" class="dugme" name="submit" value="Obrisi prijavu">
                                           </form>
                                           <br>
                                            <br>
<!--brisanje prijave kraj-->
';


            }



            ?>
        </div>
    </div>




@endsection




