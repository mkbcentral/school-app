<?php

namespace App\Http\Livewire\Application\Dashboard;

use App\Http\Livewire\Helpers\Payment\GetAmountPaymentGroupingByTypeCost;
use App\Http\Livewire\Helpers\Printing\PosPrintingHelper;
use App\Models\AppLink;
use App\Models\Payment;
use Livewire\Component;

class MainDashboard extends Component
{
    public string $day='';

    public function updatedDay($val){
       $this->emit('changeDateInscription',$val);
    }
    public function mount(){
        $this->day=date('Y-m-d');
    }

    public function testpPrint(){
        (new PosPrintingHelper())->printTest();
    }
    public function render( )
    {
        /*
        $payment=Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('students','students.id','=','payments.student_id')
            ->where('payments.student_id',134)
            ->where('students.school_id',auth()->user()->school->id)
            ->where('payments.scolary_year_id',1)
            ->where('cost_generals.type_other_cost_id',1)
            ->where('payments.month_name','09')
            ->first();
        dd($payment);
        */
        return view('livewire.application.dashboard.main-dashboard');
    }
}
