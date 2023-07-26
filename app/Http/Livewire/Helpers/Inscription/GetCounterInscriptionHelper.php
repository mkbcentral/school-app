<?php

namespace App\Http\Livewire\Helpers\Inscription;

use App\Models\Inscription;
use Illuminate\Support\Facades\DB;

class GetCounterInscriptionHelper
{
    public function getCountNewInscriptionsByDate($date,$scolaryYearId): int
    {
        return Inscription::join('students','inscriptions.student_id','=','students.id')
            ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
            ->join('rates','rates.id','=','inscriptions.rate_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.is_paied',true)
            ->whereDate('inscriptions.created_at',$date)
            ->orderBy('inscriptions.created_at','DESC')
            ->where('inscriptions.is_old_student',false)
            ->with('Cost')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->count();
    }
    public function getCountOldStudentInscriptionsByDate($date,$scolaryYearId): int
    {
        return Inscription::join('students','inscriptions.student_id','=','students.id')
            ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
            ->join('rates','rates.id','=','inscriptions.rate_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.is_paied',true)
            ->whereDate('inscriptions.created_at',$date)
            ->orderBy('inscriptions.created_at','DESC')
            ->where('inscriptions.is_old_student',true)
            ->with('Cost')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->count();
    }
}
