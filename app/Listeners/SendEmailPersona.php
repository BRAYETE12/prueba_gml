<?php

namespace App\Listeners;

use App\Events\NuevaPersona;
use App\Mail\PersonaMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailPersona
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
        $nombre = $event->persona->nombres ." ". $event->persona->apellidos;
        Mail::to($event->persona->email)->send(new PersonaMail($nombre));
    }
}
