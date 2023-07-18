<?php

namespace App\Http\Livewire\Application\Payment\List;

use App\Http\Livewire\Helpers\Inscription\GetInscriptionHelper;
use App\Http\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Models\Currency;
use App\Models\Inscription;
use App\Models\ScolaryYear;
use Livewire\Component;

class ListPaymentInscriptionValidedByDate extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
    ];
    public  $inscriptionList=[];
    public $keySearch = '', $date_to_search, $defaultScolaryYerId,$defaultCureencyName;
    public function updatedDateToSearch($val){
        $this->date_to_search=$val;
    }
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public  function  getCurrency($currency){
        $this->defaultCureencyName=$currency;
    }

    public function printBill(Inscription $inscription){
        (new PosPrintingHelper())->printInscription($inscription);
    }

    public function mount()
    {
        $this->date_to_search = date('y-m-d');
        $defaultScolaryYer = ScolaryYear::where('active', true)
            ->where('school_id',auth()->user()->school->id)
            ->first();
        $defaultCurrency = Currency::where('id', 1)
            ->where('school_id',auth()->user()->school->id)
            ->first();
        $this->defaultScolaryYerId = $defaultScolaryYer->id;
        $this->defaultCureencyName=$defaultCurrency->currency;
    }
    public function render()
    {
        $this->inscriptionList= (new GetInscriptionHelper())
            ->getDateInscriptionsPaied($this->date_to_search, $this->defaultScolaryYerId, 0, 0,$this->defaultCureencyName);
        return view('livewire.application.payment.list.list-payment-inscription-valided-by-date', ['inscriptions' => $this->inscriptionList]);
    }
}
