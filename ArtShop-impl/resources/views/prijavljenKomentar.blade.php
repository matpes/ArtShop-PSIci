
<!--komentar_id, picture_id-->

@extends('.layouts.app')


@section('head')
    <link rel="stylesheet" href="/css/Ana.css">
@endsection

@section('content')


    <div class="row">
        <div class="col-6">
          <div class="prijavljenkomentar">
              Prijavljeno od:: {{$user->username}}
              <br>
              Autor:: {{$autor->username}}
              <br>
              Komentar:: {{$komentar->tekst}}
              <br>
          </div>
            <form method="get" action="/prijave/Admin/delete">
                <input type="hidden" name="komentar_id" value="{{$komentar->id}}">
                <input type="hidden" name="picture_id" value="{{$picture->id}}">
               <!-- <input type="submit" name="submit"  value="ObrisiKomentarKaoAdmin">-->





                <button type="button" class="dugme"  data-toggle="modal" data-target="#myModal">Obrisi komentar</button>

                <!--Sanjin modal-->
                <div class="container-fluid">
                    <div class="modal" id="myModal" style="margin-top:15%;color:black;">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color:rgb(64,64,64);color:#7FF000">
                                <div class="modal-header">
                                    <h5 style="font-size:20px">Brisanje komentara</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Da li ste sigurni da želite da obrisete ovaj komentar?</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="get" action="/prijave/Admin/delete">
                                        <input type="hidden" name="_token" value="'. csrf_token() .'">
                                        <input type="hidden" name="komentar_id" value="{{$komentar->id}}">
                                        <input type="hidden" name="picture_id" value="{{$picture->id}}">

                                        <button type="submit" id="potvrdiBrisanjeKomentara" class="btn btn-warning">Potvrdi</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Odustani</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Sanjin modal-->



            </form>
        </div>
        <div class="col-5">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="nazivSlike">
                        {{$picture->naziv}}
                    </div>
                    <img src="{{$picture->path}}" alt="" class="img-fluid" width="100%">
                    <div>
                        <table class="table table-borderless">
                            <tr>
                                <td class="detaljiSlike">
                                    Slikar:
                                </td>
                                <td class="detaljiSlike">
                                    {{$picture->autor}}
                                </td>
                            </tr>


                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <br><br><br>
                    <div class="opisSlike">
                        {{$picture->opis}}
                    </div>
                    <br><br><br>

                </div>
            </div>
        </div>
        <div class="col-1">

        </div>
    </div>



@endsection
