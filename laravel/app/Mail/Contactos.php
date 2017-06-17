<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contactos extends Mailable
{
    use Queueable, SerializesModels;

    public $email,$name,$subject,$sms;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$name,$subject,$message)
    {
        $this->email=$email;
        $this->name=$name;
        $this->subject=$subject;
        $this->sms=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactos');
    }
}
