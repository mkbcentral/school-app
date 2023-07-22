<?php

namespace App\Http\Livewire\Application\Rapport\Inscription;

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
        $inscriptions=Inscription::where('inscriptions.scolary_year_id',$this->defaultScolaryYerId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->join('classes','classes.id','=','inscriptions.classe_id')
            ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
            ->join('rates','rates.id','=','inscriptions.rate_id')
            ->groupBy('classes.name')
            ->where('inscriptions.is_paied',true)
            ->where('classes.classe_option_id',$this->selectedIndex)
            ->select(
                'classes.name',
                DB::raw('count(inscriptions.id) as number'),
                DB::raw($this->defaultCureencyName=='USD'?
                    'sum(cost_inscriptions.amount) as amount':
                    'sum(cost_inscriptions.amount*rates.rate)as amount'))
            ->get();
        return view('livewire.application.rapport.inscription.rapport-inscription-by-classe',['inscriptions'=>$inscriptions]);
    }
}
