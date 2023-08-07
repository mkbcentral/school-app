<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentByMonthHelper
{
    //GET PAIMENT OF DAY
    public static function getMonthPayments($month,$idSColaryYear,$idCost,$type,$classeId,$keySearch,$currency){
        if ($classeId==0) {
                if ($idCost==0) {
                    $payments=Payment::join('students','students.id','=','payments.student_id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->join('rates','rates.id','=','payments.rate_id')
                        ->where('payments.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        ->where('students.name','Like','%'.$keySearch.'%')
                        ->where('cost_generals.type_other_cost_id',$type)
                        ->where('students.school_id',auth()->user()->school->id)
                        ->orderBy('payments.created_at','DESC')
                        ->with('cost')
                        ->with('student')
                        ->with('classe')
                        ->with('classe.classeOption')
                        ->select('payments.*',$currency=='USD'? 'cost_generals.amount as amount': DB::raw('cost_generals.amount*rates.rate as amount'))
                        ->get();
                } else {
                    $payments=Payment::join('students','students.id','=','payments.student_id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->join('rates','rates.id','=','payments.rate_id')
                        ->where('payments.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        ->where('students.name','Like','%'.$keySearch.'%')
                        ->where('cost_generals.type_other_cost_id',$type)
                        ->where('cost_general_id',$idCost)
                        ->where('students.school_id',auth()->user()->school->id)
                        ->orderBy('payments.created_at','DESC')
                        ->with('cost')
                        ->with('student')
                        ->with('classe')
                        ->with('classe.classeOption')
                        ->select('payments.*',$currency=='USD'? 'cost_generals.amount as amount': DB::raw('cost_generals.amount*rates.rate as amount'))
                        ->get();
                }
            } else {
                if ($idCost==0) {
                    $payments=Payment::join('students','students.id','=','payments.student_id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->join('rates','rates.id','=','payments.rate_id')
                        ->where('payments.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        ->where('students.name','Like','%'.$keySearch.'%')
                        ->where('cost_generals.type_other_cost_id',$type)
                        ->where('payments.classe_id',$classeId)
                        ->where('students.school_id',auth()->user()->school->id)
                        ->orderBy('payments.created_at','DESC')
                        ->with('cost')
                        ->with('student')
                        ->with('classe')
                        ->with('classe.classeOption')
                        ->select('payments.*',$currency=='USD'? 'cost_generals.amount as amount': DB::raw('cost_generals.amount*rates.rate as amount'))
                        ->get();
                } else {
                    $payments=Payment::join('students','students.id','=','payments.student_id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->join('rates','rates.id','=','payments.rate_id')
                        ->where('payments.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        ->where('students.name','Like','%'.$keySearch.'%')
                        ->where('cost_generals.type_other_cost_id',$type)
                        ->where('payments.classe_id',$classeId)
                        ->where('cost_general_id',$idCost)
                        ->where('students.school_id',auth()->user()->school->id)
                        ->orderBy('payments.created_at','DESC')
                        ->with('cost')
                        ->with('student')
                        ->with('classe')
                        ->with('classe.classeOption')
                        ->select('payments.*',$currency=='USD'? 'cost_generals.amount as amount': DB::raw('cost_generals.amount*rates.rate as amount'))
                        ->get();
                }
            }

        return $payments;
    }
}
