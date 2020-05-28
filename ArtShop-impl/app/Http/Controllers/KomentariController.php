<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Komentar;
use App\Picture;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user=Auth::user();
        return view ('newKomentari', compact('picture_id', 'autori', 'sviKomentari', 'komentarToDelete_id', 'user'));
    }


    public function store(Request $request){

        $korisnik=Auth::user();
        $korisnik_id=$korisnik->id;
        $vreme=Carbon::now();
       // return $vreme;
        Komentar::insertujKomentar($korisnik_id, $request->picture_id, $request->tekst, $vreme);

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
        //obrisati sve prijave koje se odnose na ovaj komentar
        DB::table('komentar_korisnik')->where('komentar_id',$request->komentar_id)->delete();
        return redirect('commentsOfPictureId/'.$request->picture_id);
    }


    public function prijava(Request $request){



        $korisnik=Auth::user();
        $komentar=Komentar::find($request->komentar_id);
        $k = DB::table('komentar_korisnik')->where([['komentar_id', $request->komentar_id], ['user_id', $korisnik->id]])->first();
        if($k==null) {
            DB::table('komentar_korisnik')->insert(['user_id' =>  $korisnik->id, "komentar_id" => $request->komentar_id]);

            //azuriranje brojaPrijava

            $user=User::find($korisnik->id);

            $user->brPrijava=$user->brPrijava+1;
            $user->save();
        }



        return redirect('commentsOfPictureId/'.$request->picture_id);




    }



    public function prikaziPrijave(){

        $prijave=DB::table('komentar_korisnik')->get();

        $imenaAutora=collect([]);
        foreach($prijave as $prijava){
            $autor=User::getUserById($prijava->user_id);
            $imenaAutora->push($autor);

        }

        $pictures=collect([]);
        foreach($prijave as $prijava){
            $komentar=Komentar::find($prijava->komentar_id);

            $picture = Picture::withTrashed()->find($komentar->picture_id);
            $pictures->push($picture);
        }


        return view('.Prijave',compact('prijave', 'imenaAutora', 'pictures'));

    }

}
