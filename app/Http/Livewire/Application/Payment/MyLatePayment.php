<?php

namespace App\Http\Livewire\Application\Payment;

use App\Http\Livewire\Helpers\Student\ListStudentHeleper;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class MyLatePayment extends Component
{
    use WithPagination;
    public string $keyToSearch = '';
    public $studentId = 0;

    public function showList(){
        $this->emit('latePaymentListRefresh');
    }
    public function show(Student $student)
    {
        $this->emit('studentLatePayment', $student);
        //$this->studentId = $student->id;
    }

    public function render()
    {
        $studentList = ListStudentHeleper::getListStudentForLastYear($this->keyToSearch, 20);
        return view('livewire.application.payment.my-late-payment', ['studentList' => $studentList]);
    }
}
