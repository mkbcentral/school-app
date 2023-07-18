<?php

namespace App\Http\Livewire\Application\Payment\List;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use App\Models\Student;
use Livewire\Component;

class ListStudentForPayment extends Component
{
    protected $listeners = [
        'scolaryYearFresh' => 'getScolaryYear',
    ];
    public $keySearch = '', $defaultScolaryYerId;
    public function getScolaryYear($id)
    {
        $this->defaultScolaryYerId = $id;
    }

    public function show(Student $student){
        $this->emit('studentPayment', $student);
    }
    public function mount()
    {
        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId = $defaultScolaryYer->id;
    }
    public function render()
    {
        $listInscription = Inscription::join('scolary_years', 'scolary_years.id', '=', 'inscriptions.scolary_year_id')
            ->join('students','students.id','=','inscriptions.student_id')
            ->where('students.name', 'Like', '%' . $this->keySearch . '%')
            ->where('inscriptions.scolary_year_id',$this->defaultScolaryYerId)
            ->select('inscriptions.*')
            ->orderBy('students.name','ASC')
            ->get();
        return view('livewire.application.payment.list.list-student-for-payment',['listInscription'=> $listInscription]);
    }
}
