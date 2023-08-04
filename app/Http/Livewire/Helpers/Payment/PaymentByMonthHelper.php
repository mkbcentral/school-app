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
                    $payments=Payment::join('inscriptions','payments.inscription_id','=','inscriptions.id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->join('rates','rates.id','=','payments.rate_id')
                        ->where('inscriptions.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        //->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                        ->where('cost_generals.type_other_cost_id',$type)
                        ->where('inscriptions.school_id',auth()->user()->school->id)
                        ->orderBy('payments.created_at','DESC')
                        ->with('Cost')
                        ->with('inscription.student')
                        ->with('student.classe')
                        ->with('student.classe.classeOption')
                        ->select('payments.*',$currency=='USD'? 'cost_generals.amount as amount': DB::raw('cost_generals.amount*rates.rate as amount'))
                        ->get();
                } else {
                    $payments=Payment::select('inscriptions.*','payments.*')
                        ->join('inscriptions','payments.inscription_id','=','inscriptions.id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->where('inscriptions.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        ->where('cost_general_id',$idCost)
                        ->where('cost_generals.type_other_cost_id',$type)
                        //->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                        ->where('inscriptions.school_id',auth()->user()->school->id)
                        ->orderBy('payments.created_at','DESC')
                        ->with('Cost')
                        ->with('inscription.student')
                        ->with('student.classe')
                        ->with('student.classe.classeOption')
                        ->get();
                }
            } else {
                if ($idCost==0) {
                    $payments=Payment::select('inscriptions.*','payments.*')
                        ->join('inscriptions','payments.inscription_id','=','inscriptions.id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->where('inscriptions.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        ->where('cost_generals.type_other_cost_id',$type)
                        //->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                        ->where('inscriptions.school_id',auth()->user()->school->id)
                        ->where('payments.classe_id',$classeId)
                        ->orderBy('payments.created_at','DESC')
                        ->with('Cost')
                        ->with('inscription.student')
                        ->with('student.classe')
                        ->with('student.classe.classeOption')
                        ->get();
                } else {
                    $payments=Payment::select('inscriptions.*','payments.*')
                        ->join('inscriptions','payments.inscription_id','=','inscriptions.id')
                        ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                        ->where('inscriptions.scolary_year_id',$idSColaryYear)
                        ->where('payments.month_name',$month)
                        ->where('cost_generals.type_other_cost_id',$type)
                        ->where('cost_general_id',$idCost)
                        ->where('payments.classe_id',$classeId)
                        //->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                        ->where('inscriptions.school_id',auth()->user()->school->id)
                        ->orderBy('payments.created_at','DESC')
                        ->with('Cost')
                        ->with('inscription.student')
                        ->with('student.classe')
                        ->with('student.classe.classeOption')
                        ->get();
                }
            }

        return $payments;
    }
}
