@extends('layouts.app')

@section('head')





@endsection



@section('content')

    @foreach($users as $user)

        <table>
            <tr>
                <td rowspan="3">
                    <?php

                    $path = '/images/avatar.png';
                    if($user->profilna_slika!=null){
                        $path = '/images/users//'.$user->profilna_slika;
                    }

                    ?>
                    <img width="100px" height="100px" src="{{$path}}">
                </td>
                <td colspan="2">
                  {{$user->username}}
                </td>

            </tr>
            <tr>

                <td colspan="2">
                  <?php
                    $uloga;
                     if($user->isSlikar){
                         $uloga="slikar";
                     }
                     else{
                         $uloga="kupac";
                     }
                      echo $uloga;
                    ?>
                </td>

            </tr>
            <tr>

                <td>
                    <form method="get" action="/profile/user/{{$user->id}}">
                    <button type="submit">Vidi profil</button>
                    </form>
                </td>
                <td>
                    <?php

                    if($user->deleted_at==null)
                        echo '
                    <form method="get" action="/nalozi/block/'.$user->id.'">
                        <button type="submit">Blokiraj nalog</button>
                    </form>';
                    else
                        echo '
                    <form method="get" action="/nalozi/unblock/'.$user->id.'">
                        <button type="submit">Odblokiraj nalog</button>
                    </form>';


                    ?>
                </td>
            </tr>
        </table>



      <br><br>
        <!--uloga-->
        <!--vidi nalog-->
        <!--blokiraj nalog-->
    @endforeach

@endsection
