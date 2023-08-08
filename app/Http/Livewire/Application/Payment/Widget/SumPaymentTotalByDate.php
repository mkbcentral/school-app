<?php

namespace App\Http\Livewire\Application\Payment\Widget;

use App\Http\Livewire\Helpers\Payment\GetSumAmountPaymentHeler;
use Livewire\Component;

class SumPaymentTotalByDate extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'refreshSumByDayPayment' => '$refresh',
        'changeDatePayment' => 'changeDate',
    ];

    public $total=0,$date_to_search;
    public  $defaultScolaryYerId,$defaultCureencyName;

    /**
     * Get scolaryYearId with emit in scolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
    }

    /**
     * Get date to send in child component
     * @param $date
     * @return void
     */
    public function changeDate($date): void
    {
        $this->date_to_search=$date;
    }
    /**
     * Get currency name with emit in currencyWidget listener
     * @param $currency
     * @return void
     */
    public  function  getCurrency($currency){
        $this->defaultCureencyName=$currency;
    }

    /**
     *mount component
     * @param $date
     * @param $defaultScolaryYerId
     * @param $classeId
     * @param $currency
     * @return void
     */
    public function mount($date,$defaultScolaryYerId,$currency): void
    {
        $this->date_to_search=$date;
        $this->defaultScolaryYerId=$defaultScolaryYerId;
        $this->defaultCureencyName=$currency;
    }
    public function render()
    {
        $this->total=GetSumAmountPaymentHeler::getSumAmountPaymentByDate
        ($this->date_to_search,$this->defaultScolaryYerId,$this->defaultCureencyName);
        return view('livewire.application.payment.widget.sum-payment-total-by-date',['total'=>$this->total]);
    }
}
