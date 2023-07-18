<?php

namespace App\Http\Livewire\Application\Rapport;

use App\Models\ClasseOption;
use App\Models\TypeOtherCost;
use Livewire\Component;

class PaymentRapport extends Component
{
    public $listTypeCost=[];
    public $selectedIndex = 0;
    public function changeIndex(TypeOtherCost $type)
    {
        $this->selectedIndex = $type->id;
        $this->emit('typeCostSelected', $this->selectedIndex);
    }
    public function mount(){
        $this->listTypeCost=TypeOtherCost::where('school_id',auth()->user()->school->id)
            ->where('scolary_year_id',2)
            ->get();
        $defaultTypeCost=TypeOtherCost::find(12);
        $this->selectedIndex=$defaultTypeCost->id;
    }
    public function render()
    {
        return view('livewire.application.rapport.payment-rapport');
    }
}
