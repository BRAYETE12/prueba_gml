<?php

namespace App\Events;

use App\Models\Persona;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class NuevaPersona
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Persona  $persona;
    public string   $emailAdministrador;
    public $dataPaises;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Persona  $persona)
    {
        $this->persona = $persona;

        $this->emailAdministrador = Env('MAIL_FOR_ADMIN');
        
        $this->dataPaises = Persona::select('pais', DB::raw('count(1) as total'))
                                    ->groupBy('pais')->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-NuevaPersona');
    }
}
