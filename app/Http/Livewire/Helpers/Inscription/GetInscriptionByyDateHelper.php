<?php

namespace App\Http\Livewire\Helpers\Inscription;

use App\Models\Inscription;
use Illuminate\Support\Facades\DB;

class GetInscriptionByyDateHelper
{
    public function getDateInscriptions($date,$scolaryYearId,$classeId,$costId,$currency){
        if ($classeId==0) {
            if ($costId==0) {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->get();
            } else {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.cost_inscription_id',$costId)
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->get();
            }

        } else {
            if ($costId==0) {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.classe_id',$classeId)
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->get();
            } else {
                $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->where('inscriptions.classe_id',$classeId)
                    ->where('inscriptions.cost_inscription_id',$costId)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->get();
            }

        }
        return $inscriptions;
    }
}
