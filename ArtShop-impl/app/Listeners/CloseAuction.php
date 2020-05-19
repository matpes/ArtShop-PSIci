<?php

namespace App\Listeners;

use App\Events\Auction;
use App\Mail\pictureLost;
use App\Picture;
use App\User;
use App\ZaOcenu;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

use App\Mail\pictureWon;


/**
 * Class CloseAuction
 * @package App\Listeners
 * Listener za zatvaranje aukcija.
 */
class CloseAuction implements ShouldQueue
{

    /**
     * Handle the event.
     *  Ako je aukcija istekla, event se obradjuje, a ako nije, event se vraca u bazu, za kasniju obradu
     * @param  Auction  $event
     * @return void
     */
    public function handle(Auction $event)
    {
        //
        $pic = $event->picture;
        $picture = Picture::find($pic->id);
        if(Carbon::parse($event->picture->danIstekaAukcije)->diffInMinutes(Carbon::now(), false)>0){
            //ZATVARANJE AUKCIJE
            $pobednik = null;
            $gubitnici = null;
            $picture->krajAukcije($pobednik, $gubitnici);

            foreach ($pobednik as $pob){
                Mail::to(User::find($pob->user_id)->email)->send(new pictureWon($event->picture));
                $zaOcenu = new ZaOcenu;
                $zaOcenu->picture_id = $picture->id;
                $zaOcenu->user_id = $pob->user_id;
                $zaOcenu->ocena = 0;
                $zaOcenu->save();
                sleep(1);
            }

            foreach ($gubitnici as $gub){
                Mail::to(User::find($gub->user_id)->email)->send(new pictureLost($event->picture));
                sleep(1);
            }

            $picture->delete();


        }else{
            event(new Auction($picture));
        }

        sleep(60);
    }
}
