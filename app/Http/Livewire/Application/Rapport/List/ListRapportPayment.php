<?php

namespace App\Http\Livewire\Application\Rapport\List;

use App\Http\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Payment\PaymentByDateHelper;
use App\Http\Livewire\Helpers\Payment\PaymentByMonthHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use App\Models\Currency;
use Livewire\Component;

class ListRapportPayment extends Component
{
    protected $listeners = [
        'paymentListRefresh' => '$refresh',
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'typeCostSelected'=>'getTypeCost'
    ];
    public $keyToSearch='',$date_to_search,$defaultCureencyName;
    public $defaultScolaryYerId;
    public $index=0,$cost_id=0,$classe_id=0;
    public $classeList=[];
    public $months=[],$month;
    public $listPayments;

    /**
     * Reset date to search on null after month property is updated
     * @return void
     */
    public function updatedMonth(): void
    {
        $this->date_to_search=null;
    }

    /**
     * updated cost id property
     * @param $val
     * @return void
     */
    public function updatedCostId($val): void
    {
        $this->cost_id=$val;
    }

    /**
     * Updated classe id property
     * @param $val
     * @return void
     */
    public function updatedClasseId($val): void
    {
        $this->classe_id=$val;
    }

    /**
     * Get selected scolaryYear id with emit ScolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
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

    /**
     * Update index property for type cost id selected
     * @param $id
     * @return void
     */
    public function getTypeCost($id): void
    {
        $this->index=$id;
    }

    /**
     * Mounted component
     * @param $index
     * @return void
     */
    public function mount($index): void
    {
        $this->index=$index;
        $this->classeList=(new SchoolHelper())->getListClasse();
        $this->months=(new DateFormatHelper())->getMonthsForYear();
        $this->month=date('m');

        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId=$defaultScolaryYer->id;

        $defaultCurrency = (new SchoolHelper())->getCurrentCurrency();
        $this->defaultCureencyName=$defaultCurrency->currency;

    }

    /**
     * Loading initial data
     * @return void
     */
    public function loadData(): void
    {

        if($this->date_to_search==null){
            $this->listPayments=PaymentByMonthHelper::getMonthPayments(
                $this->month,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->index,
                $this->classe_id,
                $this->keyToSearch,
                $this->defaultCureencyName
            );
        }else{
            $this->listPayments=PaymentByDateHelper::getDatePaiments(
                $this->date_to_search,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->index,
                $this->classe_id,
                $this->keyToSearch,
                $this->defaultCureencyName
            );
        }
    }

    public function render()
    {
        $listCost=(new CostGeneralHelper())->getListCostGeneral($this->index,$this->defaultScolaryYerId);
        $this->loadData();
        return view('livewire.application.rapport.list.list-rapport-payment',
            ['listCost' => $listCost,'listPayments'=>$this->listPayments]);
    }
}
