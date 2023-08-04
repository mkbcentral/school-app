<?php

namespace App\Http\Livewire\Application\Receipts;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Inscription\GetInscriptionByDateWithPaymentStatusHelper;
use App\Http\Livewire\Helpers\Payment\GetAmountPaymentGroupingByTypeCost;
use App\Http\Livewire\Helpers\SchoolHelper;
use Livewire\Component;

class CostOtherPaymentReceiptsByMonth extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
    ];
    public array  $months=[];
    public ?string $month,$defaultCureencyName;
    public ?float $amountInscription;
    public ?int $scolaryYearId;


    public function updatedMonth($val): void
    {
        $this->month=$val;
    }

    /**
     * Get selected scolaryYear id with emit ScolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->scolaryYearId = $id;
    }

    /**
     * Get selected currency with emit CurrencyWidget listener
     * @param $currency
     * @return void
     */
    public  function  getCurrency($currency): void
    {
        $this->defaultCureencyName=$currency;
    }

    public  function mount(){
        $this->months=(new DateFormatHelper())->getMonthsForYear();
        $this->month=date('m');
        $defaultCurrency = (new SchoolHelper())->getCurrentCurrency();
        $this->defaultCureencyName=$defaultCurrency->currency;
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        $this->scolaryYearId=$scolaryYear->id;
    }
    public function render()
    {
        $this->amountInscription=(new GetInscriptionByDateWithPaymentStatusHelper())
            ->getSumTotalAmountInscriptionByMonth($this->month,$this->scolaryYearId,0,0,$this->defaultCureencyName,true);
        $listReceipt=GetAmountPaymentGroupingByTypeCost::getAmountPaymentByMonth($this->month,$this->scolaryYearId,$this->defaultCureencyName);
        return view('livewire.application.receipts.cost-other-payment-receipts-by-month',['listReceipt'=>$listReceipt]);
    }
}
