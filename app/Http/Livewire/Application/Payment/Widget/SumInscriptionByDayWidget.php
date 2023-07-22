<?php

namespace App\Http\Livewire\Application\Payment\Widget;

use App\Http\Livewire\Helpers\Inscription\GetInscriptionHelper;
use Livewire\Component;

class SumInscriptionByDayWidget extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'refreshSumByDayInscription' => '$refresh',
        'changeDateSumInscription' => 'changeDate',
    ];
    public $total=0,$date_to_search;
    public  $defaultScolaryYerId,$defaultCureencyName,$classe_id = 0;

    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }
    public function changeDate($date){
        $this->date_to_search=$date;
    }
    public  function  getCurrency($currency){
        $this->defaultCureencyName=$currency;
    }

    public function mount($date,$defaultScolaryYerId,$classeId,$currency){
        $this->date_to_search=$date;
        $this->defaultScolaryYerId=$defaultScolaryYerId;
        $this->classe_id=$classeId;
        $this->defaultCureencyName=$currency;
    }
    public function render()
    {
        $this->total= (new GetInscriptionHelper())
            ->getDateSumTotalInscription($this->date_to_search, $this->defaultScolaryYerId, $this->classe_id, 0,$this->defaultCureencyName,true);
        return view('livewire.application.payment.widget.sum-inscription-by-day-widget',['total'=>$this->total]);
    }
}
