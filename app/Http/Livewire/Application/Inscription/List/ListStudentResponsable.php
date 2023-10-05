<?php

namespace App\Http\Livewire\Application\Inscription\List;

use App\Http\Livewire\Helpers\Notifications\SmsNotificationHelper;
use App\Models\Student;
use App\Models\StudentResponsable;
use App\Models\User;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ListStudentResponsable extends Component
{
    use WithPagination;
    protected $listeners = [
        'selectedClasseOption' => 'getOptionSelected',
        'refreshListResponsible' => '$refresh'
    ];
    public $name_responsable, $phone, $other_phone, $email;

    public  int $selectedIndex = 0;
    public string $keyToSearch = '';
    public StudentResponsable $studentResponsable;
    public function mount(int $index): void
    {
        $this->selectedIndex = $index;
    }
    public  function getOptionSelected($index): void
    {
        $this->selectedIndex = $index;
    }

    public function show(StudentResponsable $studentResponsable)
    {
        $this->studentResponsable = $studentResponsable;
        $this->name_responsable = $studentResponsable->name_responsable;
        $this->phone = $studentResponsable->phone;
        $this->other_phone = $studentResponsable->other_phone;
        $this->email = $studentResponsable->email;
    }

    public function delete($id)
    {
        $responsable = StudentResponsable::find($id);
        if ($responsable->students->isEmpty()) {
            $responsable->delete();
            $this->dispatchBrowserEvent('added', ['message' => "Famille bien rétirée !"]);
        } else {
            $this->dispatchBrowserEvent('error', ['message' => "Impossible, Famille déjà remplie"]);
        }
    }
    public function deleteInFamilly($id)
    {
        $student = Student::find($id);
        $student->student_responsable_id = null;
        $student->update();
        $this->dispatchBrowserEvent('added', ['message' => "Enfant bien rérité de la famille !"]);
    }

    public function updateFamilly()
    {
        $this->validate(
            [
                'name_responsable' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'other_phone' => ['nullable', 'string'],
                'email' => ['nullable', 'string'],
            ]
        );
        $this->studentResponsable->name_responsable = $this->name_responsable;
        $this->studentResponsable->phone = $this->phone;
        $this->studentResponsable->other_phone = $this->other_phone;
        $this->studentResponsable->email = $this->email;
        $this->studentResponsable->update();
        $this->dispatchBrowserEvent('updated', ['message' => "Infos bien mise à jour !"]);
    }

    public function sendBulkSMS(){
        try {
            $users=User::all();
            foreach ($users as $user) {
                SmsNotificationHelper::sendSMS(
                    '+243898337969',
                    '+243' . $user->phone,
                    'C.S.'.auth()->user()->school->name."\n Juste un essaie technique \nA: ".date('Y-m-d H:i:s')
                );
            }
            $this->dispatchBrowserEvent('added', ['message' => 'Message bien envoyer']);
        } catch (Exception $ex) {
            $this->dispatchBrowserEvent('error', ['message' => $ex->getMessage()]);
        }
    }

    
    public function showFromSoSendSms(StudentResponsable $studentResponsable)
    {
        $this->emit('studentToSedSMS', $studentResponsable);
    }

    public function getResponsable(StudentResponsable $responsable): void
    {
        $this->emit('selectRresposableId', $responsable);
    }
    public function render()
    {
        return view(
            'livewire.application.inscription.list.list-student-responsable',
            [
                'listResponsible' => StudentResponsable::where(
                    'school_id',auth()->user()->school->id)
                    ->where('name_responsable', 'like', '%' . $this->keyToSearch . '%')
                    ->orderBy('created_at', 'DESC')
                    ->with('students')
                    ->paginate(10)
            ]
        );
    }
}
