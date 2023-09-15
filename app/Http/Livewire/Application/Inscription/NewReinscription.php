<?php

namespace App\Http\Livewire\Application\Inscription;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Student\ListStudentHeleper;
use App\Models\Payment;
use App\Models\ScolaryYear;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class NewReinscription extends Component
{
    use WithPagination;
    public string $keyToSearch = '';
    public $studentId=0;


    public function show(Student $student){
        $this->emit('studentReinscription', $student);
        $this->studentId=$student->id;
    }
    public function mount(){
        $scolaryYears=ScolaryYear::where('active',false)->get();
        $years=array();
        $mothData=array();
        foreach ($scolaryYears as $year){
            $years[]=$year->id;
        }
        foreach ((new DateFormatHelper())->getMonthsForYear() as $month){
            $mothData[]=$month;
        }
        $payments=Payment::whereNotIn('students.scolary_year_id',$years)
            ->join('students','students.id','=','payments.student_id')
            ->where('payments.student_id',$this->studentId)
            ->where('students.school_id',1)
            ->whereIn('payments.month_name',$mothData)
            ->get();
    }
    public function render()
    {
        $studentList = ListStudentHeleper::getListStudentForLastYear($this->keyToSearch,20);
        return view('livewire.application.inscription.new-reinscription', ['studentList'=> $studentList]);
    }
}
