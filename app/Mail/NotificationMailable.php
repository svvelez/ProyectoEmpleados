<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $empleado;


    public function __construct($empleado)
    {
        $this->empleado = $empleado;

    }

    public function build()
    {
        return $this->view('emails.notificaciones')
            ->from("soporteweb@dime.com.co")
            ->subject("Bienvenid@ a DIME");
    }
}
