<?php

namespace App\Http\Livewire\Application\Payment\Widget;

use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Models\Student;
use Livewire\Component;

class StatusPaylentCheckerWidget extends Component
{
    public array $typeCostSelected = [];
    public $listOldCostType = [];
    public $listTypeCost = [], $months = [];
    public Student $student;

    public function mount(Student $student)
    {
        $this->student  = $student;
    }
    public function render()
    {
        $this->listOldCostType = (new TypeCostHelper())->getListDisableOldTypeCost();
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
        return view('livewire.application.payment.widget.status-paylent-checker-widget');
    }
}
