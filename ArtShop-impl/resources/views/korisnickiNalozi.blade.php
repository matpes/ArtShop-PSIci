@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/css/Ana.css">
@endsection



@section('content')
    <div class="row">

        <div class="col-sm-1">

        </div>
        <div class="col-sm-10">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-sm-6">

                        <table class="table table-borderless">
                            <tr>
                                <td rowspan="3">
                                    <?php

                                    $path = '/images/avatar.png';
                                    if ($user->picture_path != null) {
                                        $path = '/images/users//' . $user->picture_path;
                                    }

                                    ?>
                                    <img width="100px" height="100px" src="{{$path}}" class="img-fluid">
                                </td>
                                <td colspan="2">
                                    <?php echo "<h3>" . $user->username . "</h3>"?>
                                </td>

                            </tr>
                            <tr>

                                <td colspan="2">
                                    Tip naloga: &nbsp;
                                    <?php
                                    $uloga;
                                    if ($user->isSlikar) {
                                        $uloga = "slikar";
                                    } else {
                                        $uloga = "kupac";
                                    }
                                    echo $uloga;
                                    ?>
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <form method="get" action="/admin/profile/info/{{$user->id}}">
                                        <button class="dugme" type="submit" style="width: 100%">Vidi profil</button>
                                    </form>
                                </td>
                                <td>
                                    <?php

                                    if ($user->deleted_at == null)
                                        echo '
                    <form method="get" action="/nalozi/block/' . $user->id . '">
                        <button class="dugme"  type="submit" style="width: 100%">Blokiraj nalog</button>
                    </form>';
                                    else
                                        echo '
                    <form method="get" action="/nalozi/unblock/' . $user->id . '">
                        <button class="dugme"  type="submit" style="width: 100%">Odblokiraj nalog</button>
                    </form>';


                                    ?>
                                </td>
                            </tr>
                        </table>


                    </div>

                    <!--uloga-->
                    <!--vidi nalog-->
                    <!--blokiraj nalog-->
                @endforeach
            </div>
        </div>


        <div class="col-sm-1">

        </div>


    </div>


@endsection
