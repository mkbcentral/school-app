<?php

namespace App\Http\Livewire\Application\Rapport\Inscription;

use App\Http\Livewire\Helpers\Inscription\GetInscriptionWithGrouping;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;
use App\Models\Inscription;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RapportInscriptionByClasse extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
    ];
    public $listClasseOption=[];
    public $selectedIndex = 0,$selectedClasseOption;
    public $defaultScolaryYerId,$defaultCureencyName;
    public function mount(){
        $this->selectedClasseOption= ClasseOption::first();
        $this->selectedIndex =  $this->selectedClasseOption->id;
        $this->listClasseOption=(new SchoolHelper())->getListClasseOption();
        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $defaultCurrency =(new SchoolHelper())->getCurrentCurrency();
        $this->defaultScolaryYerId = $defaultScolaryYer->id;
        $this->defaultCureencyName=$defaultCurrency->currency;
    }
    public function changeIndex(ClasseOption $option)
    {
        $this->selectedIndex = $option->id;
        $this->selectedClasseOption=$option;
        $this->emit('selectedClasseOption', $this->selectedIndex);;
    }
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public  function  getCurrency($currency){
        $this->defaultCureencyName=$currency;
    }
    public function render()
    {
        $inscriptions=(new GetInscriptionWithGrouping())
            ->getAmountInscriptionGroupingByCalsseWithSelectedOption($this->selectedIndex,$this->defaultScolaryYerId,$this->defaultCureencyName);
        return view('livewire.application.rapport.inscription.rapport-inscription-by-classe',
            ['inscriptions'=>$inscriptions]);
    }
}
