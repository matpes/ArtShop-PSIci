<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class pictureWon extends Mailable
{
    use Queueable, SerializesModels;

    public $picture;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($picture)
    {
        //
        $this->picture = $picture;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('psiciartshop@gmail.com')->subject('Pobedili ste na aukciji')->view('mails.pictureWon');
    }

}
