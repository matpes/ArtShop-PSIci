<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class pictureLost
 * @package App\Mail
 * Klasa koja predstavlja slanje maila koji se salje ucesnicima aukcije koji nusu kupili sliku
 */
class pictureLost extends Mailable
{

    use Queueable, SerializesModels;

    public $picture;

    /**
     * pictureLost constructor.
     * @param $picture
     */
    public function __construct($picture)
    {
        $this->picture = $picture;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('psiciartshop@gmail.com')->subject('Pobedili niste na aukciji')->view('mails.pictureLost');
    }
}
