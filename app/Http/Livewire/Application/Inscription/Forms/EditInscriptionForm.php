<?php

namespace App\Http\Livewire\Application\Inscription\Forms;

use App\Http\Livewire\Helpers\Responsable\CreateNewResponsableHelper;
use App\Http\Requests\EditStudentRequest;
use App\Models\Classe;
use App\Models\CostInscription;
use App\Models\Gender;
use App\Models\Inscription;
use App\Models\Student;
use App\Models\StudentResponsable;
use Livewire\Component;

class EditInscriptionForm extends Component
{
    protected $listeners = ['studentAndInscription' => 'getStudentAndInscription'];
    public  $student = null,$age='';
    public $costInscriptionList = [], $genderList = [];
    public $name, $date_of_birth, $place_of_birth, $gender;
    public $name_responsable, $phone, $other_phone, $email;

    public function getStudentAndInscription(Student $student)
    {
        $this->student = $student;
    }

    public function update()
    {
        $request = new EditStudentRequest();
        $data = $this->validate($request->rules());
        $this->student->update($data);
        if ($this->student->responsable != null) {
            $this->student->responsable->name_responsable = $data['name_responsable'];
            $this->student->responsable->phone = $data['phone'];
            $this->student->responsable->other_phone = $data['other_phone'];
            $this->student->responsable->email = $data['email'];
            $this->student->responsable->update();
        } else {
            $data =[
                'name_responsable' => $data['name_responsable'],
                'phone' => $data['phone'],
                'other_phone' => $data['other_phone'],
                'email' => $data['email'],
            ];
            $responsable=CreateNewResponsableHelper::create($data);
            $this->student->student_responsable_id = $responsable->id;
            $this->student->update();
        }
        $this->dispatchBrowserEvent('updated', ['message' => "Info bien mise jour!"]);
        $this->emit('refreshListInscription');
        $this->student=null;
    }

    public function resetFrom(){
        $this->student=null;
    }

    public function mount()
    {
        $this->costInscriptionList = CostInscription::where('school_id', auth()->user()->school->id)
            ->orderBy('created_at', 'DESC')->get();
        $this->genderList = Gender::all();

    }

    public function render()
    {

        $this->name = $this->student?->name;
        $this->date_of_birth = $this->student?->date_of_birth->format('Y-m-d');
        $this->place_of_birth = $this->student?->place_of_birth;
        $this->gender = $this->student?->gender;
        $this->age=$this->student?->getAge($this->student?->date_of_birth);
        if ($this->student?->responsable != null) {
            $this->name_responsable = $this->student?->responsable?->name_responsable;
            $this->phone = $this->student?->responsable?->phone;
            $this->other_phone = $this->student?->responsable?->other_phone;
            $this->email = $this->student?->responsable?->email;
        }
        return view('livewire.application.inscription.forms.edit-inscription-form');
    }
}
