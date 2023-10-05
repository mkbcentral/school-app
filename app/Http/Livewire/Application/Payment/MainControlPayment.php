<?php

namespace App\Http\Livewire\Application\Payment;

use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\TypeOtherCost;
use Livewire\Component;

class MainControlPayment extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public $defaultScolaryYerId;
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
        //dd($this->selectedIndex);
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
     * Mounted component
     * @return void
     */
    public function mount(): void
    {
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId=$scolaryYear->id;

    }
    public function render()
    {
        $this->listTypeCost=(new TypeCostHelper())->getListTypeCost($this->defaultScolaryYerId);
        $defaultTypeCost=(new TypeCostHelper())->getFirstTypeCostActive($this->defaultScolaryYerId);
        $this->isByTranch=$defaultTypeCost?->is_by_tranch;
        $this->selectedIndex=$defaultTypeCost->id;
        return view('livewire.application.payment.main-control-payment');
    }
}
