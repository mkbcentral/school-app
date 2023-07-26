<?php

namespace App\Http\Livewire\Application\Payment\List;

use App\Http\Livewire\Helpers\Inscription\GetInscriptionByDateWithPaymentStatusHelper;
use App\Http\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\Inscription;
use App\Models\ScolaryYear;
use Livewire\Component;

class ListPaymentInscriptionValidedByDate extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'refreshInscriptionByDay'=>'$refresh',
        'changeDateInscription' => 'changeDate',
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
    public function changeDate($date)
    {
        $this->date_to_search=$date;
    }

    public function printBill(Inscription $inscription){
        (new PosPrintingHelper())->printInscription($inscription,$this->defaultCureencyName);
    }

    public function mount()
    {
        $this->date_to_search=date('Y-m-d');
        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $defaultCurrency =(new SchoolHelper())->getCurrentCurrency();
        $this->defaultScolaryYerId = $defaultScolaryYer->id;
        $this->defaultCureencyName=$defaultCurrency->currency;
    }
    public function render()
    {

        $this->inscriptionList= (new GetInscriptionByDateWithPaymentStatusHelper())
            ->getDateInscriptions($this->date_to_search, $this->defaultScolaryYerId, 0, 0,$this->defaultCureencyName);
        return view('livewire.application.payment.list.list-payment-inscription-valided-by-date', ['inscriptions' => $this->inscriptionList]);
    }
}
