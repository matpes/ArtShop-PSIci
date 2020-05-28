<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Komentar;
use App\Picture;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function showAllComments(Request $request){ //iz requesta se dobija picture_id, a user_id dobijam preko AUTH



        $picture_id=$request->picture_id;

        return redirect('commentsOfPictureId/'.$picture_id);
        /* $both= Komentar::allComments($picture_id);
         $autori=$both->pop();

         $sviKomentari=$both->pop();
         // $komentars=Komentar::all(); //dohvatili sve komentare iz baze u kolekciju $komentars

         //compact--> every name from the record which is arguments transforms into variable :)

         return view ('komentari', compact('picture_id', 'autori', 'sviKomentari'));*/

    }
    public function showAllCommentsOfPicture($id){
        $picture_id=$id;
        $both= Komentar::allComments($picture_id);
        $autori=$both->pop();

        $sviKomentari=$both->pop();
        /* foreach($sviKomentari as $komentar){
             echo $komentar->tekst;
             echo '<br>';
         }
         return "THIS IS END";*/
        // $komentars=Komentar::all(); //dohvatili sve komentare iz baze u kolekciju $komentars

        //compact--> every name from the record which is arguments transforms into variable :)
        $komentarToDelete_id=10; //nebitna vrednost
        return view ('komentariAdmin', compact('picture_id', 'autori', 'sviKomentari', 'komentarToDelete_id'));
    }
    public function komentarSlika(Request $request){

        $prijava_id=$request->prijava_id;
         $prijava=DB::table('komentar_korisnik')->where('id', $prijava_id )->get();

         $user_id=$prijava[0]->user_id; //autor prijave
         $user=User::find($user_id);
         $komentar_id=$prijava[0]->komentar_id;
         $komentar=Komentar::find($komentar_id);
         $autor_id=$komentar->user_id; //autor komentara
         $autor=User::find($autor_id);
         $picture_id=$komentar->picture_id;
         $picture = Picture::withTrashed()->find($picture_id);

         //view komentar slika u cosku

        return view('prijavljenKomentar', compact('picture', 'komentar', 'user', 'autor'));


    }


    public function delete(Request $request){
        //povecavanje broja uspesnih prijava svima koji su prijavili taj komentar

        $prijave=DB::table('komentar_korisnik')->where('komentar_id', $request->komentar_id)->get();

        foreach($prijave as $prijava){

            $user=User::find($prijava->user_id);
            $user->brUspesnihPrijava= $user->brUspesnihPrijava+1;
            $user->save();

        }


        //brisanje komentara
        $komentar=Komentar::findOrFail($request->komentar_id);
        $komentar->delete();
        //TO DO:obrisat i prijavu tj sve prijave koje se odnose na obrisani komentar jer posle u prikazivanju prijava se dohvata komentar.
        //a komentar vise ne postoji

        DB::table('komentar_korisnik')->where('komentar_id', $request->komentar_id)->delete();

        //return redirect('commentsOfPictureId/'.$request->picture_id);

        //ridajrektuje na
        return redirect('prijave/show');
    }


    public function sviKorisnickiNalozi(){


        $users=User::withTrashed()->get();

        return view ('korisnickiNalozi', compact('users'));
    }


    public function profileInfo($user_id){
       $user=User::find($user_id);

        $slikar = DB::table('slikars')
            ->where('user_id', '=', $user_id)
            ->first();
        $brOcena = 0;
        if(!is_null($slikar)){
            $brOcena = DB::table('pictures')
                ->join('za_ocenus','za_ocenus.picture_id','=','pictures.id')
                ->where('pictures.user_id','=', $slikar->user_id)
                ->count();
        }
        return response()->view('profile.info',['user'=>$user, 'slikar'=>$slikar, 'brOcena'=>$brOcena]);
    }


    public function blokirajNalog($user_id){

       $user=User::find($user_id);
       $user->delete(); //soft delete
       //to do: brisati sve sto se odnosi na njega???

      return redirect('nalozi/show');
    }

    public function odblokirajNalog($user_id){
        User::withTrashed()->find($user_id)->restore();
        //to do: restorovat sve sto se odnosi na njega
        return redirect('nalozi/show');
    }



}
