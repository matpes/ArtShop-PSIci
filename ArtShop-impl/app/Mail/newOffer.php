<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class newOffer extends Mailable
{
    use Queueable, SerializesModels;

    public $picture;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($slika)
    {
        //
        $this->picture = $slika;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('psiciartshop@gmail.com')->subject('Nova ponuda')->view('mails.newOffer');
    }
}
