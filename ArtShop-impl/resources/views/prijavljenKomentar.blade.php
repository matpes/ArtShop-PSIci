
<!--komentar_id, picture_id-->

@extends('.layouts.app')



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
                <input type="submit" name="submit"  value="ObrisiKomentarKaoAdmin">
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
