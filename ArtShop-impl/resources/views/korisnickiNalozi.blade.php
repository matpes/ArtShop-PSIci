@extends('layouts.app')

@section('head')





@endsection



@section('content')

    @foreach($users as $user)

        <table>
            <tr>
                <td rowspan="3">
                    <img width="80px" height="80px" src=<?php if(is_null($user->picture_path)) {
                        echo 'images/avatar.png';
                    }
                    else{
                        $path='images/users/'.$user->picture_path;
                        echo $path;
                    }
                        ?>>
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
                    <form method="get" action="/nalozi/block/{{$user->id}}">
                        <button type="submit">Blokiraj nalog</button>
                    </form>
                </td>
            </tr>
        </table>



      <br><br>
        <!--uloga-->
        <!--vidi nalog-->
        <!--blokiraj nalog-->
    @endforeach

@endsection
