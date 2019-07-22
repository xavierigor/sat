<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitacaoOrientacaoAceita extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $aluno, $professor;

    public function __construct($aluno, $professor)
    {
        $this->aluno = $aluno;
        $this->professor = $professor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.solicitacaoOrientacaoAceita')
        return $this->markdown('emails.solicitacaoOrientacaoAceita')
                    ->subject('Solicitação de Orientação Aceita');
    }
}
