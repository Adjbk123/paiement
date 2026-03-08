<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PaiementInscription;
use Barryvdh\DomPDF\Facade\Pdf;

class RecuPaiementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paiement;
    public $parametres;

    public function __construct(PaiementInscription $paiement, $parametres = null)
    {
        $this->paiement = $paiement;
        $this->parametres = $parametres;
    }

    public function build()
    {
        $pdf = Pdf::loadView('email.paiement_recu', [
            'paiement' => $this->paiement,
            'logo' => $this->parametres?->photo ? asset('uploads/' . $this->parametres->photo) : asset('uploads/default.png'),
            'siteName' => $this->parametres?->website_name ?? 'MAFLYT SARL'
        ])->setPaper('A4', 'portrait');

        return $this->from('maflyt26@gmail.com', 'MAFLYT')
                    ->subject('Reçu officiel de votre paiement - MAFLYT')
                    ->view('email.paiement_recu') // version HTML mail
                    ->attachData(
                        $pdf->output(),
                        'recu-paiement-' . ($this->paiement->transaction_id ?? 'paiement') . '.pdf',
                        ['mime' => 'application/pdf']
                    );
    }
}
