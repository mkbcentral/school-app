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

    public function updatedMonth(){
        $this->date_to_search=null;
    }
    public function updatedCostId($val){
        $this->cost_id=$val;
    }
    public function updatedClasseId($val){
        $this->classe_id=$val;
    }
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }

    public  function  getCurrency($currency){
        $this->defaultCureencyName=$currency;
    }

    public function getTypeCost($id){
        $this->index=$id;
    }

    public function mount($index){
        $this->index=$index;
        $this->classeList=(new SchoolHelper())->getListClasse();
        $this->months=(new DateFormatHelper())->getMonthsForYear();
        $this->month=date('m');

        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId=$defaultScolaryYer->id;

        $defaultCurrency = Currency::where('id', 1)
            ->where('school_id',auth()->user()->school->id)
            ->first();
        $this->defaultCureencyName=$defaultCurrency->currency;
    }
    public function loadData(){
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
        $listCost=(new CostGeneralHelper())->getListCostGeneralHelper($this->index,2);
        $this->loadData();
        return view('livewire.application.rapport.list.list-rapport-payment',
            ['listCost' => $listCost,'listPayments'=>$this->listPayments]);
    }
}
