<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class KomentariController extends Controller
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
        return view ('komentari', compact('picture_id', 'autori', 'sviKomentari', 'komentarToDelete_id'));
    }


    public function store(Request $request){

        $korisnik=Auth::user();
        $korisnik_id=$korisnik->id;
        Komentar::insertujKomentar($korisnik_id, $request->picture_id, $request->tekst, $request->vreme);

        //return redirect('/comment');

      //  return redirect('picturenew/'.$request->picture_id);
        $picture_id=$request->picture_id;
        return redirect('commentsOfPictureId/'.$picture_id);
    }

    public function medjuFunkcija(Request $request){


        $picture_id=$request->picture_id;
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
        $komentarToDelete_id=$request->komentar_id; //sada bitna vrednost
        return view ('komentari', compact('picture_id', 'autori', 'sviKomentari', 'komentarToDelete_id'));
    }


    public function delete(Request $request){

        //brisanje komentara
        $komentar=Komentar::findOrFail($request->komentar_id);
        $komentar->delete();
        return redirect('commentsOfPictureId/'.$request->picture_id);
    }
}
