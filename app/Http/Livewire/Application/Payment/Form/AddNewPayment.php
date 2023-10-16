<?php

namespace App\Http\Livewire\Application\Payment\Form;

use App\Http\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Payment\CreatePaymentCheckerHelper;
use App\Http\Livewire\Helpers\Payment\CreateNewPaymentHelper;
use App\Http\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use App\Models\Student;
use Livewire\Component;

class AddNewPayment extends Component
{
    protected $listeners =
        [
            'studentPayment' => 'getStudent',
            'scolaryYearFresh' => 'getScolaryYear',
        ];
    public  $student = null;
    public $listTypeCost=[],$listOtherCost;
    public $type_other_cost_id,$cost_general_id;
    public $months=[],$month;
    public $defaultScolaryYerId;
    public  $amountLabel='';
    public $currency='';

    public function updatedTypeOtherCostId($val): void
    {
        $this->type_other_cost_id=$val;
    }

    public function updatedCostGeneralId($val): void{
        $this->amountLabel=CostGeneralHelper::getCostById($val)->amount;
        $this->currency=CostGeneralHelper::getCostById($val)->currency->currency;
    }
    public function getStudent(Student $student): void
    {
        $this->student = null;
        $this->student = $student;
    }
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
    }
    public function store(): void
    {
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        $this->validateForm();
        $paymentChecker=CreatePaymentCheckerHelper::checkIfPaymentExistBeforCreate(
            $this->student->id,
            $this->month,
            $this->cost_general_id,
            $scolaryYear->id
        );
        if ($paymentChecker){
            $this->dispatchBrowserEvent('error',['message'=>'Désolé,cet élève a déjà un paiement pour ce mois']);
        }else{
            $cost=CostGeneral::find($this->cost_general_id);
            $payment= CreateNewPaymentHelper::create(
                $this->month,
                $this->cost_general_id,
                $this->student->inscription->classe->classeOption->id,
                $this->student->inscription->id,
                $this->student->id,
                $scolaryYear->id,
                $this->student->inscription->classe->id
            );
            $cost=CostGeneral::find($this->cost_general_id);
            //(new PosPrintingHelper())->printPayment($payment,'USD');
            $this->emit('paymentListRefresh');
            $this->dispatchBrowserEvent('added',['message'=>'Paiement bien effectué']);
        }
    }

    public function validateForm(): void
    {
        $this->validate([
            'month' => ['required', 'string'],
            'cost_general_id' => ['required', 'numeric'],
            'type_other_cost_id' => ['required', 'numeric'],
        ]);
    }

    public function mount(): void
    {
        $this->month=date('m');
        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId=$defaultScolaryYer->id;
        $this->listTypeCost=(new TypeCostHelper())->getListTypeCost($this->defaultScolaryYerId);
        $this->months=(new DateFormatHelper())->getMonthsForYear();
    }
    public function render()
    {
        $this->listOtherCost=(new CostGeneralHelper())->getListCostGeneral($this->type_other_cost_id,$this->defaultScolaryYerId);
        return view('livewire.application.payment.form.add-new-payment', ['classeList' =>   $this->listOtherCost]);
    }
}
