<?php
namespace  App\Http\Livewire\Helpers\Inscription;

use App\Models\Inscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetInscriptionHelper{
    //GET DATE INSCRIPTIONS
    public function getDateInscriptions($date,$scolaryYearId,$classeId,$costId,$currency,$ispaied=true){
        if ($classeId==0) {
           if ($costId==0) {
            $inscriptions=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.is_paied',$ispaied)
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->with('student.classe.option')
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
                   ->where('inscriptions.is_paied',$ispaied)
                   ->with('Cost')
                   ->with('student')
                   ->with('school')
                   ->with('classe')
                   ->with('student.classe.option')
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
                    ->where('inscriptions.is_paied',$ispaied)
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->with('student.classe.option')
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
                    ->where('inscriptions.is_paied',$ispaied)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->with('student.classe.option')
                    ->select('inscriptions.*',$currency=='USD'? 'cost_inscriptions.amount as amount': DB::raw('cost_inscriptions.amount*rates.rate as amount'))
                    ->get();
            }

        }
        return $inscriptions;
    }

    public function getDateSumTotalInscription($date,$scolaryYearId,$classeId,$costId,$currency,$ispaied=true){
        if ($classeId==0) {
            if ($costId==0) {
               $total=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.is_paied',$ispaied)
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->with('student.classe.option')
                    ->sum($currency=='USD'? 'cost_inscriptions.amount': DB::raw('cost_inscriptions.amount*rates.rate '));

            } else {
                $total=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.cost_inscription_id',$costId)
                    ->where('inscriptions.is_paied',$ispaied)
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->with('student.classe.option')
                    ->sum($currency=='USD'? 'cost_inscriptions.amount': DB::raw('cost_inscriptions.amount*rates.rate '));
            }

        } else {
            if ($costId==0) {
                $total=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->where('inscriptions.classe_id',$classeId)
                    ->where('inscriptions.is_paied',$ispaied)
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->with('student.classe.option')
                    ->sum($currency=='USD'? 'cost_inscriptions.amount': DB::raw('cost_inscriptions.amount*rates.rate '));
            } else {
                $total=Inscription::join('students','inscriptions.student_id','=','students.id')
                    ->join('cost_inscriptions','cost_inscriptions.id','=','inscriptions.cost_inscription_id')
                    ->join('rates','rates.id','=','inscriptions.rate_id')
                    ->where('inscriptions.scolary_year_id',$scolaryYearId)
                    ->whereDate('inscriptions.created_at',$date)
                    ->where('inscriptions.classe_id',$classeId)
                    ->where('inscriptions.cost_inscription_id',$costId)
                    ->where('inscriptions.is_paied',$ispaied)
                    ->orderBy('inscriptions.created_at','DESC')
                    ->with('Cost')
                    ->with('student')
                    ->with('school')
                    ->with('classe')
                    ->with('student.classe.option')
                    ->sum($currency=='USD'? 'cost_inscriptions.amount': DB::raw('cost_inscriptions.amount*rates.rate '));
            }

        }
        return  $total;
    }
}
