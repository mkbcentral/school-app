<?php

namespace App\Http\Livewire\Application\Payment\Form;

use App\Http\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Payment\CreateNewPaymentHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\ScolaryYear;
use App\Models\Student;
use Illuminate\Support\Collection;
use Livewire\Component;

class NewLatePayment extends Component
{
    protected $listeners = ['studentLatePayment' => 'getStudent'];
    public ?Student $student;
    public ScolaryYear $lastScolaryYear;
    public Collection $listCurrency,$listTypeCost,$listCost;
    public array $months=[];
    public string $month,$created_at;
    public $type_cost_id,$amount,$cost_general_id;
    public $currency;

    public function updatedTypeCostId($val){
        $this->type_cost_id=$val;
    }

    public function getStudent(Student $student): void
    {
        $this->student = null;
        $this->student = $student;
    }
    public function store(){
        $inputs=$this->validate([
            'month'=>['required','string'],
            'currency'=>['required','string'],
            'amount'=>['required','numeric'],
            'type_cost_id'=>['required','numeric'],
            'cost_general_id'=>['required','numeric'],
            'created_at'=>['required','date']
        ]);
        $inputs['inscription_id']=$this->student->inscription->id;
        $inputs['option_id']=$this->student->inscription->classe->classeOption->id;
        CreateNewPaymentHelper::createLatePayment($inputs);
        $this->dispatchBrowserEvent('added',['message'=>'Paiement bien effectué']);
        $this->emit('latePaymentListRefresh');
    }

    public function mount(){
        $this->lastScolaryYear=(new SchoolHelper)->getOldScolaryYear();
        $this->listCurrency=(new SchoolHelper)->getCurrencyList();
        $this->months=(new DateFormatHelper())->getMonthsForScolaryYear();
        $this->listTypeCost=(new TypeCostHelper())->getListDisableOldTypeCost();
        $this->created_at=date('d-m-Y');
    }
    public function render()
    {
        $oldScolaryYear = (new SchoolHelper)->getOldScolaryYear();
        $this->listCost=(new CostGeneralHelper())->getListCostGeneral($this->type_cost_id,$oldScolaryYear->id);
        return view('livewire.application.payment.form.new-late-payment');
    }
}
