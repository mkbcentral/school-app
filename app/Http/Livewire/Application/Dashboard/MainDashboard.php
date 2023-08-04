<?php

namespace App\Http\Livewire\Application\Dashboard;

use App\Http\Livewire\Helpers\Payment\GetAmountPaymentGroupingByTypeCost;
use App\Models\AppLink;
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
    public function render( )
    {
        return view('livewire.application.dashboard.main-dashboard');
    }
}
