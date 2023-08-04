<?php
namespace  App\Http\Livewire\Helpers\Payment;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentByDateHelper{
    //GET PAIMENT OF DAY
    public static function getDatePayments($date,$idSColaryYear,$idCost,$type,$classeId,$keySearch,$currency){
        if ($type==0){
           if ($classeId==0) {
               if ($idCost==0) {
                   $payments=Payment::join('inscriptions','inscriptions.id','=','payments.inscription_id')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('rates','rates.id','=','payments.rate_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       //->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->orderBy('payments.created_at','DESC')
                       ->where('inscriptions.school_id',auth()->user()->school->id)
                       ->with('Cost')
                       ->select('payments.*',$currency=='USD'? 'cost_generals.amount as amount': DB::raw('cost_generals.amount*rates.rate as amount'))
                       ->get();
                   //dd($date);
               } else {
                   $payments=Payment::select('inscriptions.*','payments.*')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('inscriptions','inscriptions.id','payments.inscription_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->orderBy('payments.created_at','DESC')
                       ->where('inscriptions.school_id',auth()->user()->school->id)
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.classeOption')
                       ->get();
               }
           } else {
               if ($idCost==0) {
                   $payments=Payment::select('inscriptions.*','payments.*')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('inscriptions','inscriptions.id','payments.inscription_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       ->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->where('payments.classe_id',$classeId)
                       ->where('inscriptions.school_id',auth()->user()->school->id)
                       ->orderBy('payments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.classeOption')
                       ->get();
               } else {
                   $payments=Payment::select('inscriptions.*','payments.*')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('inscriptions','inscriptions.id','payments.inscription_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('payments.classe_id',$classeId)
                       ->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->where('inscriptions.school_id',auth()->user()->school->id)
                       ->orderBy('payments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.classeOption')
                       ->get();
               }
           }
       }else{
           if ($classeId==0) {
               if ($idCost==0) {
                   $payments=Payment::select('inscriptions.*','payments.*')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('inscriptions','inscriptions.id','payments.inscription_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->where('inscriptions.school_id',auth()->user()->school->id)
                       ->orderBy('payments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.classeOption')
                       ->get();
                   //dd($date);
               } else {
                   $payments=Payment::select('inscriptions.*','payments.*')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('inscriptions','inscriptions.id','payments.inscription_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->where('inscriptions.school_id',auth()->user()->school->id)
                       ->orderBy('payments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.classeOption')
                       ->get();
               }
           } else {
               if ($idCost==0) {
                   $payments=Payment::select('inscriptions.*','payments.*')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('inscriptions','inscriptions.id','payments.inscription_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->where('payments.classe_id',$classeId)
                       ->where('school_id',auth()->user()->school->id)
                       ->orderBy('payments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.classeOption')
                       ->get();
               } else {
                   $payments=Payment::select('inscriptions.*','payments.*')
                       ->join('cost_generals','cost_generals.id','=','payments.cost_general_id')
                       ->join('inscriptions','inscriptions.id','payments.inscription_id')
                       ->where('inscriptions.scolary_year_id',$idSColaryYear)
                       ->whereDate('payments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('payments.classe_id',$classeId)
                       ->where('inscriptions.student.name','Like','%'.$keySearch.'%')
                       ->where('school_id',auth()->user()->school->id)
                       ->orderBy('payments.created_at','DESC')
                       ->with('Cost')
                       ->with('inscription')
                       ->get();
               }
           }
       }
        return $payments;
    }

}
