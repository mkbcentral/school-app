<?php

namespace App\Http\Livewire\Application\Rapport;

use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use App\Models\TypeOtherCost;
use Livewire\Component;

class PaymentRapport extends Component
{
    protected $listeners = [

        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public string $keyToSearch = '';
    public $defaultScolaryYerId;
    public $listTypeCost=[];
    public $selectedIndex = 0;
    public  $status=true;

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
     * Get selected scolaryYear id with emit ScolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
        $this->status =!$this->status;
    }

    /**
     * Mounted component
     * @return void
     */
    public function mount(): void
    {
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId=$scolaryYear->id;

        $defaultTypeCost=(new TypeCostHelper())->getFirstTypeCostActive($scolaryYear->id);
        $this->selectedIndex=$defaultTypeCost->id;
    }
    public function render()
    {
        $this->listTypeCost=(new TypeCostHelper())->getListTypeCost($this->defaultScolaryYerId,$this->status);
        return view('livewire.application.rapport.payment-rapport');
    }
}
