<?php

namespace App\Http\Livewire\Application\Rapport;

use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use App\Models\TypeOtherCost;
use Livewire\Component;

class PaymentRapport extends Component
{
    public $listTypeCost=[];
    public $selectedIndex = 0;

    /**
     * Change index for selected Type cost
     * @param TypeOtherCost $type
     * @return void
     */
    public function changeIndex(TypeOtherCost $type): void
    {
        $this->selectedIndex = $type->id;
        $this->emit('typeCostSelected', $this->selectedIndex);
    }

    /**
     * Mounted component
     * @return void
     */
    public function mount(): void
    {
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        $this->listTypeCost=(new TypeCostHelper())->getListTypeCost($scolaryYear->id);
        $defaultTypeCost=(new TypeCostHelper())->getFirstTypeCostActive($scolaryYear->id);
        $this->selectedIndex=$defaultTypeCost->id;
    }
    public function render()
    {
        return view('livewire.application.rapport.payment-rapport');
    }
}
