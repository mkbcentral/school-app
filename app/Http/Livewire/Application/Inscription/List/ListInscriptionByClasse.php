<?php

namespace App\Http\Livewire\Application\Inscription\List;

use App\Http\Livewire\Helpers\Inscription\GetAllInscriptionHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Classe;
use App\Models\Inscription;
use App\Models\Student;
use Livewire\Component;

class ListInscriptionByClasse extends Component
{
    public $keyToSearch = '';
    public $classeId;
    public $inscriptions;
    public $classeData;
    public function mount($classe){
       $this->classeId=$classe;
       $this->classeData=Classe::find($classe);
    }

    public function edit(Student $student)
    {
        $this->emit('studentAndInscription', $student);
    }
    public function editInscription(Inscription $inscription)
    {
        $this->emit('inscriptionToEdit', $inscription,
        $inscription->classe->classeOption->id);
    }

    public function delete($id){
        $inscription=Inscription::find($id);
        $student=Student::find($inscription->student_id);
        $scolayYear=(new SchoolHelper())->getCurrectScolaryYear();
        if($inscription->payments->isEmpty()){
            $inscription->delete();
            if($student->scolaryYear->id==$scolayYear->id){
                $student->delete();
            }
            $this->dispatchBrowserEvent('added', ['message' => "Famille bien rétirée !"]);
        }else{
            $this->dispatchBrowserEvent('error', ['message' => "Impossible, Famille déjà remplie"]);
        }

    }

    public function render()
    {
        $this->inscriptions=GetAllInscriptionHelper::getListInscriptionByClasseForCurrentYear($this->classeId,$this->keyToSearch);
        return view('livewire.application.inscription.list.list-inscription-by-classe');
    }
}
