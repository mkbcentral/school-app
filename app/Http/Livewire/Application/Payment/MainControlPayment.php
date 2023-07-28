<?php

namespace App\Http\Livewire\Application\Payment;

use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\TypeOtherCost;
use Livewire\Component;

class MainControlPayment extends Component
{
    public $listTypeCost=[];
    public $selectedIndex = 0;
    public bool $isByTranch=false;

    /**
     * Change index for selected Type cost
     * @param TypeOtherCost $type
     * @return void
     */
    public function changeIndex(TypeOtherCost $type): void
    {
        $this->selectedIndex = $type->id;
        $this->isByTranch=$type->is_by_tranch;
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
        $this->isByTranch=$defaultTypeCost->is_by_tranch;
        $this->selectedIndex=$defaultTypeCost->id;
    }
    public function render()
    {
        return view('livewire.application.payment.main-control-payment');
    }
}
