<?php

namespace App\Http\Livewire\Application\Inscription;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Models\Paiment;
use App\Models\Payment;
use App\Models\ScolaryYear;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class NewReinscription extends Component
{
    use WithPagination;
    public string $keyToSearch = '';



    public function show(Student $student){
        $this->emit('studentReinscription', $student);
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
        $payments=Payment::whereNotIn('inscriptions.scolary_year_id',$years)
            ->join('inscriptions','inscriptions.id','payments.inscription_id')
            ->where('student_id',25)
            ->where('school_id',1)
            ->whereIn('month_name',$mothData)
            ->get();
    }
    public function render()
    {
        $studentList = Student::join('scolary_years', 'scolary_years.id', '=', 'students.scolary_year_id')
            ->where('scolary_years.active', false)
            ->where('students.school_id',auth()->user()->school->id)
            ->where('students.name', 'Like', '%' . $this->keyToSearch . '%')
            ->select('students.*')
            ->orderBy('students.name','ASC')
            ->paginate(20);
        return view('livewire.application.inscription.new-reinscription', ['studentList'=> $studentList]);
    }
}
