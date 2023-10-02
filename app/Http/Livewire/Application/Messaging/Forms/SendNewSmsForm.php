<?php

namespace App\Http\Livewire\Application\Messaging\Forms;

use App\Models\Student;
use App\Models\StudentResponsable;
use Livewire\Component;

class SendNewSmsForm extends Component
{
    protected $listeners = ['studentToSedSMS' => 'getStudent'];
    public $body;
    public StudentResponsable $studentResponsable;

    public function getStudent(StudentResponsable $studentResponsable) {
        $this->studentResponsable=$studentResponsable;
    }
    public function render()
    {
        return view('livewire.application.messaging.forms.send-new-sms-form');
    }
}
