<?php

namespace App\Http\Livewire\Application\Inscription\Forms;

use App\Http\Livewire\Helpers\Cost\CostInscriptionHelper;
use App\Http\Livewire\Helpers\Inscription\CreateInscriptionHelper;
use App\Http\Livewire\Helpers\Responsable\CreateNewResponsableHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Http\Livewire\Helpers\Student\StundentHelper;
use App\Http\Requests\NewStudentRequest;
use App\Models\Student;
use App\Models\StudentResponsable;
use Livewire\Component;
class CreateNewInscriptionForm extends Component
{
    protected $listeners = [
        'selectedClasseOption' => 'getOptionSelected',
        'selectRresposableId'=>'getIdResponsable'
    ];
    public $costInscriptionList = [], $genderList = [];
    public $selectedOption = 0,$defaultScolaryYear;
    public $name, $date_of_birth, $gender, $classe_id, $cost_inscription_id,$place_of_birth;
    public ?StudentResponsable $responsable;
    public  function getOptionSelected($index): void
    {
        $this->selectedOption=$index;
    }
    public function getIdResponsable(StudentResponsable $responsable):void{
        $this->responsable=$responsable;
    }
    public function store(): void
    {
        $request = new NewStudentRequest();
        $data = $this->validate($request->rules());
        $studentChek = Student::where('name', $data['name'])->first();
        if ($studentChek) {
            $this->dispatchBrowserEvent('deleted', ['message' => "Désolé cet élève existe déjà !"]);
        } else {
            $data['scolary_year_id']=$this->defaultScolaryYear->id;
            $data['school_id']=auth()->user()->school->id;
            $data['student_responsable_id']=$this->responsable->id;
            $student= StundentHelper::create($data);
            (new CreateInscriptionHelper())
                ->create(
                    $this->defaultScolaryYear->id,
                    $data['cost_inscription_id'],
                    $student->id,
                    $data['classe_id'],
                    $this->selectedOption
                );
            $this->dispatchBrowserEvent('added', ['message' => "Action bien réalisée !"]);
            //$this->emit('refreshListInscription');
            $this->emit('refreshListResponsible');
        }
    }
    public function mount(int $index): void
    {
        $this->selectedOption=$index;
        $this->costInscriptionList = (new CostInscriptionHelper())->getListCostInscription();;
        $this->genderList = (new SchoolHelper())->getListOfGender();
        $this->defaultScolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
    }
    public function render()
    {
        $classeList = (new SchoolHelper())->getListClasseByOption($this->selectedOption);
        return view('livewire.application.inscription.forms.create-new-inscription-form', ['classeList' => $classeList]);
    }
}
