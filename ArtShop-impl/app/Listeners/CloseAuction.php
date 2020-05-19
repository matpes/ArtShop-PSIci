<?php

namespace App\Listeners;

use App\Events\Auction;
use App\Mail\pictureLost;
use App\Picture;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

use App\Mail\pictureWon;



class CloseAuction implements ShouldQueue
{

    /**
     * Handle the event.
     *
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
            }

            foreach ($gubitnici as $gub){
                Mail::to(User::find($gub->user_id)->email)->send(new pictureLost($event->picture));
            }

        }else{
            event(new Auction($picture));
            //sleep(10);
        }
    }
}
