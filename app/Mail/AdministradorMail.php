<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdministradorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Notificación reporté registros - GML';
    public $dataPaises;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataPaises)
    {
        $this->dataPaises = $dataPaises;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reporteAdministrador')
                    ->with(['dataPaises' => $this->dataPaises]);
    }
}
