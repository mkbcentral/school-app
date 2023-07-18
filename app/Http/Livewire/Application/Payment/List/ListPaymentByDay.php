<?php

namespace App\Http\Livewire\Application\Payment\List;

use App\Http\Livewire\Helpers\Payment\PaymentByDateHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\Paiment;
use Livewire\Component;

class ListPaymentByDay extends Component
{
    protected $listeners = [
        'paymentListRefresh' => '$refresh',
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency'
    ];
    public $keyToSearch='',$date_to_search,$defaultCureencyName;
    public $defaultScolaryYerId;
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }

    public  function  getCurrency($currency){
        $this->defaultCureencyName=$currency;
    }

    public function edit(Paiment $payment){
        $this->emit('paymentToEdit',$payment);
    }

    public function mount()
    {
        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId=$defaultScolaryYer->id;
        $defaultCurrency = Currency::where('id', 1)
            ->where('school_id',auth()->user()->school->id)
            ->first();
        $this->defaultCureencyName=$defaultCurrency->currency;
        $this->date_to_search = date('Y-m-d');

    }

    public function render()
    {
        $listPayments=(new PaymentByDateHelper())->getDatePaiments(
            $this->date_to_search,
            $this->defaultScolaryYerId,
            0,
            0,
            0,
            $this->keyToSearch,
            $this->defaultCureencyName
        );
        return view('livewire.application.payment.list.list-payment-by-day',['listPayments'=>$listPayments]);
    }
}
