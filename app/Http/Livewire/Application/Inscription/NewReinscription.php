<?php

namespace App\Http\Livewire\Application\Inscription;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Models\Paiment;
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
        //dd($mothData);
        $payments=Paiment::whereNotIn('scolary_year_id',$years)
            ->where('student_id',25)
            ->where('school_id',1)
            ->whereIn('mounth_name',$mothData)
            ->get();
        //dd($payments);
    }
    public function render()
    {
        $studentList = Student::join('scolary_years', 'scolary_years.id', '=', 'students.scolary_year_id')
            ->where('scolary_years.active', false)
            ->select('students.*')
            ->where('students.name', 'Like', '%' . $this->keyToSearch . '%')
            ->orderBy('students.name','ASC')
            ->paginate(10);
        return view('livewire.application.inscription.new-reinscription', ['studentList'=> $studentList]);
    }
}
