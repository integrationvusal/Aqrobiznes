<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function build()
    {
        return $this
                ->from('testemailprogrammer@gmail.com', 'Tets Programmer')
                ->subject('Hello Worlds')
                ->view('email.contact');
    }
}