<?php

namespace App\Http\Livewire\Application\Inscription\Forms;

use App\Http\Livewire\Helpers\Cost\CostInscriptionHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Inscription\CreateInscriptionHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Http\Requests\NewStudentRequest;
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
    public $selectedOption = 0;
    public $defaultScolaryYear;

    public $name, $date_of_birth, $gender, $classe_id, $cost_inscription_id;

    public function getOptionSelected($index)
    {
        $this->selectedOption = $index;
    }

    public function store()
    {
        $request = new NewStudentRequest();
        $data = $this->validate($request->rules());
        //Check if student exist
        $studentChek = Student::where('name', $data['name'])->first();
        if ($studentChek) {
            $this->dispatchBrowserEvent('data-deleted', ['message' => "Désolé cet élève existe déjà !"]);
        } else {
            $student = Student::create([
                'name' => $data['name'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'scolary_year_id'=> $this->defaultScolaryYear->id,
            ]);
            (new CreateInscriptionHelper())
                ->create(
                    $this->defaultScolaryYear->id,
                    $data['cost_inscription_id'],
                    $student->id,
                    $data['classe_id']
                );
            $this->dispatchBrowserEvent('added', ['message' => "Inscription bien sauvegargée !"]);
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
