<?php

namespace App\Http\Livewire\Application\Payment;

use App\Http\Livewire\Helpers\Inscription\GetInscriptionHelper;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Mediumart\Orange\SMS\Http\SMSClient;
use Mediumart\Orange\SMS\SMS;

class ValideInscriptionPayment extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public  $inscriptionList = [];

    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public function loadData():Collection
    {
      return  $this->inscriptionList = (new GetInscriptionHelper())
            ->getDateInscriptions($this->date_to_search, $this->defaultScolaryYerId, $this->classe_id, 0);
    }
    public function render()
    {
        return view('livewire.application.payment.valide-inscription-payment');
    }
}
