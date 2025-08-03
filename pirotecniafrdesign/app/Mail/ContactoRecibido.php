<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contacto;

class ContactoRecibido extends Mailable
{
    use Queueable, SerializesModels;

    public $contacto;

    public function __construct(Contacto $contacto)
    {
        $this->contacto = $contacto;
    }

    public function build()
    {
        return $this->subject($this->contacto->asunto)
            ->view('emails.contacto');
    }
}
