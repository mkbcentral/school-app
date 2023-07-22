<?php

namespace App\Http\Livewire\Application\Inscription\Forms;

use App\Http\Livewire\Helpers\Cost\CostInscriptionHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Inscription\CreateInscriptionHelper;
use App\Http\Livewire\Helpers\Invoice\FormatInvoiceNumberHelper;
use App\Http\Livewire\Helpers\Responsable\CreateNewResponsableHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Http\Livewire\Helpers\Student\StundentHelper;
use App\Http\Requests\NewStudentRequest;
use App\Http\Requests\NewStudentResponsableRequest;
use App\Models\Classe;
use App\Models\CostInscription;
use App\Models\Gender;
use App\Models\Inscription;
use App\Models\ScolaryYear;
use App\Models\Student;
use Livewire\Component;

class CreateNewInscriptionForm extends Component
{
    protected $listeners = ['selectedClasseOption' => 'getOptionSelected'];
    public $costInscriptionList = [], $genderList = [];
    public $selectedOption = 0,$defaultScolaryYear,$student;
    public $name, $date_of_birth, $gender, $classe_id, $cost_inscription_id,$place_of_birth;
    public $name_responsable,$phone,$other_phone,$email;
    public function getOptionSelected($index)
    {
        $this->selectedOption = $index;
    }
    public function store()
    {
        $request = new NewStudentRequest();
        $data = $this->validate($request->rules());
        $studentChek = Student::where('name', $data['name'])->first();
        if ($studentChek) {
            $this->dispatchBrowserEvent('deleted', ['message' => "Désolé cet élève existe déjà !"]);
        } else {
            $data['scolary_year_id']=$this->defaultScolaryYear->id;
            $student= StundentHelper::create($data);
            (new CreateInscriptionHelper())
                ->create(
                    $this->defaultScolaryYear->id,
                    $data['cost_inscription_id'],
                    $student->id,
                    $data['classe_id'],
                    $this->selectedOption
                );
            if ($data['name_responsable']!=null){
                $responsable=CreateNewResponsableHelper::create($data);
                $student->student_responsable_id=$responsable->id;
                $student->update();
            }
            $this->dispatchBrowserEvent('added', ['message' => "Action bien réalisée !"]);
            $this->emit('refreshListInscription');
        }
    }
    public function mount()
    {
        $this->costInscriptionList = (new CostInscriptionHelper())->getListCostInscription();;
        $this->genderList = (new SchoolHelper())->getListOfGender();
        $this->defaultScolaryYear=ScolaryYear::where('active',true)->first();
    }
    public function render()
    {
        $classeList = (new SchoolHelper())->getListClasseByOption($this->selectedOption);
        return view('livewire.application.inscription.forms.create-new-inscription-form', ['classeList' => $classeList]);
    }
}
