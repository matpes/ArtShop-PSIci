<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class spMail
 * @package App\Http\Controllers
 * @deprecated
 */
class spMail extends Controller
{
    //
    /**
     * Author: Pešić Matija 17/0428
     * --------------------------------------
     * spMail
     * --------------------------------------
     */

    public static function newOffer($slika, $korime){
        $picture = $slika;
        $korisnici = $picture->getSveUcesnike();
        $data = [
            'title' => 'Novosti za sliku: '. $picture->naziv,
            'content' => 'Neko je dao vecu ponudu za ovu sliku.',
            'link' => 'artshop.test/picture/'.$slika->id
        ];
        foreach ($korisnici as $korisnik) {
            if($korisnik->id != $korime) {
                Mail::send('mails.test', $data, function ($message) use ($korisnik) {
                    $message->to($korisnik->mail, $korisnik->username)->subject('Obavestenje o aukciji');
                });
            }
        }
    }
}
