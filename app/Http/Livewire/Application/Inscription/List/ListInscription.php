<?php

namespace App\Http\Livewire\Application\Inscription\List;

use App\Http\Livewire\Helpers\Inscription\GetInscriptionHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use App\Models\Student;
use Livewire\Component;

class ListInscription extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'refreshListInscription' => '$refresh',
        'selectedClasseOption' => 'getOptionSelected',
    ];
    public  $inscriptionList=[];
    public $keySearch = '', $date_to_search, $defaultScolaryYerId,$defaultCureencyName;
    public $classeList, $classe_id = 0;
    public $classeOptionList, $classe_option_id = 0;
    public $selectedIndex = 0;

    public function updatedClasseOptionId($val){
        $this->classe_option_id=$val;
    }

    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }

    public  function  getCurrency($currency){
    $this->defaultCureencyName=$currency;
    }

    public function getOptionSelected($index)
    {
        $this->selectedIndex = $index;
    }

    //Valided payment inscription
    public  function valideInscriptionPayement(Inscription $inscription){
        if ($inscription->is_paied==false){
            $inscription->is_paied=true;
        }else{
            $inscription->is_paied=false;
        }
        $inscription->update();
        $this->dispatchBrowserEvent('added', ['message' => "Paiement inscription validée !"]);
    }

    public function mount($index)
    {
        $this->selectedIndex = $index;
        $this->date_to_search = date('Y-m-d');

        $this->classeOptionList =(new SchoolHelper())->getListClasseOption();

        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $defaultCurrency =(new SchoolHelper())->getCurrentCurrency();

        $this->defaultScolaryYerId = $defaultScolaryYer->id;
        $this->defaultCureencyName=$defaultCurrency->currency;
    }
    public function loadData(){
        $this->inscriptionList= (new GetInscriptionHelper())
        ->getDateInscriptions($this->date_to_search, $this->defaultScolaryYerId, $this->classe_id, 0,$this->defaultCureencyName);
    }
    public function edit(Student $student)
    {
        $this->emit('studentAndInscription', $student);
    }
    public function editInscription(Inscription $inscription)
    {
        $this->emit('inscriptionToEdit', $inscription,$this->selectedIndex==0?$this->classe_option_id:$this->selectedIndex);
    }
    public function render()
    {
        if ($this->classe_option_id == 0) {
            $this->classeList = (new SchoolHelper())->getListClasseByOption($this->selectedIndex);
        } else {
            $this->classeList = (new SchoolHelper())->getListClasseByOption($this->classe_option_id);
        }
        $this->loadData();
        return view('livewire.application.inscription.list.list-inscription', ['inscriptions' => $this->inscriptionList]);
    }
}
