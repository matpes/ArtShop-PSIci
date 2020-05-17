<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPicture extends Mailable
{
    use Queueable, SerializesModels;

    public $username, $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $id)
    {
        $this->username = $username;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("PSI")
            ->view('email.NewPictureNotification');
    }
}
