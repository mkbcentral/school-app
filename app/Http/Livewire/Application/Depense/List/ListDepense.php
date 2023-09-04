<?php

namespace App\Http\Livewire\Application\Depense\List;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Depense\DepenseHelper;
use App\Models\Depense;
use Livewire\Component;

class ListDepense extends Component
{
    public  array $months = [];
    public string $month,$date;

    public function updatedDate($val){
        dd($val);
    }

    public function mount()
    {
        $this->month = date('m');
        $this->date = date('d/m/Y');
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
    }

    public function render()
    {
        return view('livewire.application.depense.list.list-depense',['listDepense'=>Depense::all()]);
    }
}
