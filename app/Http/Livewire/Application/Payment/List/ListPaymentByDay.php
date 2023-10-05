<?php

namespace App\Http\Livewire\Application\Payment\List;

use App\Http\Livewire\Helpers\Payment\GetPaymentByDateHelper;
use App\Http\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\Payment;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class ListPaymentByDay extends Component
{
    protected $listeners = [
        'paymentListRefresh' => '$refresh',
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency'
    ];

    public function updatedDateToSearch($val){
        $this->emit('changeDatePayment',$val);
    }

    public $keyToSearch='',$date_to_search,$defaultCureencyName;
    public $defaultScolaryYerId;

    public function getScolaryYear($id):void
    {
        $this->defaultScolaryYerId = $id;
    }

    public  function  getCurrency($currency):void{
        $this->defaultCureencyName=$currency;
    }

    public function edit(Payment $payment): void
    {
        $this->emit('paymentToEdit',$payment);
       
    }
    public function printBill(Payment $payment):void{;
        if($payment->is_paid==true){
            $payment->is_paid=false;
            //(new PosPrintingHelper())->printPayment($payment,$this->defaultCureencyName);
        }else{
            $payment->is_paid=true;
        }
        $payment->update();
        $this->emit('refreshSumByDayPayment');
        $this->dispatchBrowserEvent('added', ['message' => "Action réalisée avec succès !"]);
    }
    public function delete(string $id){
        $payment=Payment::find($id);
        $payment->delete();
        $this->dispatchBrowserEvent('updated', ['message' => "Payment bien rétiré !"]);
    }
    public function mount(): void
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
        $listPayments=GetPaymentByDateHelper::getDatePayments(
            $this->date_to_search,
            $this->defaultScolaryYerId,
            0,
            0,
            0,
            $this->keyToSearch,
            $this->defaultCureencyName);
        return view('livewire.application.payment.list.list-payment-by-day',['listPayments'=>$listPayments]);
    }
}
