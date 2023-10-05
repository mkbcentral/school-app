<?php

namespace App\Http\Livewire\Application\Payment\List;

use App\Http\Livewire\Application\Payment\OtherCostPayment;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Inscription\GetListInscriptionByClasseHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\TypeOtherCost;
use Livewire\Component;

class ListStudentControlByMonth extends Component
{
    protected $listeners = [
        'paymentListRefresh' => '$refresh',
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'typeCostSelected'=>'getTypeCost'
    ];
    public $keyToSearch='',$date_to_search;
    public $defaultScolaryYerId;
    public $index=0,$cost_id=0,$classe_id=0,$classe_option_id=0;
    public $classeList=[];
    public $months=[],$month;
    public $listStudent;
    public $lisClasseOption=[];
    public $typeCost;

    public function updatedClasseId($val): void
    {
        $this->classe_id=$val;
    }

    public function updatedClasseOptionId($val): void
    {
        $this->classe_option_id=$val;
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
     * Update index property for type cost id selected
     * @param $id
     * @return void
     */
    public function getTypeCost($id): void
    {
        $this->index=$id;
        $this->typeCost=TypeOtherCost::find($id);
    }


    /**
     * Mounted component
     * @param $index
     * @return void
     */
    public function mount($index): void
    {
        $this->index=$index;
        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId=$defaultScolaryYer->id;
        $this->months=(new DateFormatHelper())->getMonthsForScolaryYear();
        $this->lisClasseOption=(new SchoolHelper())->getListClasseOption();
        $this->typeCost=TypeOtherCost::find($this->index);
    }

    public function render()
    {
        
        $this->classeList=(new SchoolHelper())->getListClasseByOption($this->classe_option_id);
        $this->listStudent=GetListInscriptionByClasseHelper::getListInscrptinForCurrentYear($this->classe_id);
        return view('livewire.application.payment.list.list-student-control-by-month');
    }
}
