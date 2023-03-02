<?php

namespace App\Listeners;

use App\Events\NuevaPersona;
use App\Mail\AdministradorMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAdministrador
{
   
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NuevaPersona  $event
     * @return void
     */
    public function handle(NuevaPersona $event)
    {
        Mail::to($event->emailAdministrador)->send(new AdministradorMail($event->dataPaises));
    }
}
