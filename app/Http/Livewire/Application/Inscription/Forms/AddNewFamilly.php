<?php

namespace App\Http\Livewire\Application\Inscription\Forms;

use App\Http\Livewire\Helpers\Responsable\CreateNewResponsableHelper;
use App\Http\Requests\NewStudentResponsableRequest;
use Livewire\Component;

class AddNewFamilly extends Component
{
    public $name_responsable,$phone,$other_phone,$email;

    public function store(): void
    {
        $request = new NewStudentResponsableRequest();
        $data = $this->validate($request->rules());
        $data['school_id']=auth()->user()->school->id;
        CreateNewResponsableHelper::create($data);
        $this->dispatchBrowserEvent('added', ['message' => "Famille bien créée !"]);
        $this->emit('refreshListResponsible');
        $this->emit('refreshListInscription');
    }
    public function render()
    {
        return view('livewire.application.inscription.forms.add-new-familly');
    }
}
