<?php
namespace  App\Http\Livewire\Helpers\Payment;
use App\Models\Paiment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentByDateHelper{
    //GET PAIMENT OF DAY
    public static function getDatePaiments($date,$idSColaryYear,$idCost,$type,$classeId,$keySearch,$currency){
       if ($type==0){
           if ($classeId==0) {
               if ($idCost==0) {
                   $paiements=Paiment::join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->join('rates','rates.id','=','paiments.rate_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->select('paiments.*',$currency=='USD'? 'cost_generals.amount as amount': DB::raw('cost_generals.amount*rates.rate as amount'))
                       ->get();
                   //dd($date);
               } else {
                   $paiements=Paiment::select('students.*','paiments.*')
                       ->join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->get();
               }
           } else {
               if ($idCost==0) {
                   $paiements=Paiment::select('students.*','paiments.*')
                       ->join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->where('paiments.classe_id',$classeId)
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->get();
               } else {
                   $paiements=Paiment::select('students.*','paiments.*')
                       ->join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('paiments.classe_id',$classeId)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->get();
               }
           }
       }else{
           if ($classeId==0) {
               if ($idCost==0) {
                   $paiements=Paiment::select('students.*','paiments.*')
                       ->join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->get();
                   //dd($date);
               } else {
                   $paiements=Paiment::select('students.*','paiments.*')
                       ->join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->get();
               }
           } else {
               if ($idCost==0) {
                   $paiements=Paiment::select('students.*','paiments.*')
                       ->join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->where('paiments.classe_id',$classeId)
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->get();
               } else {
                   $paiements=Paiment::select('students.*','paiments.*')
                       ->join('students','paiments.student_id','=','students.id')
                       ->join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
                       ->where('paiments.scolary_year_id',$idSColaryYear)
                       ->whereDate('paiments.created_at',$date)
                       ->where('cost_general_id',$idCost)
                       ->where('cost_generals.type_other_cost_id',$type)
                       ->where('paiments.classe_id',$classeId)
                       ->where('students.name','Like','%'.$keySearch.'%')
                       ->orderBy('paiments.created_at','DESC')
                       ->with('Cost')
                       ->with('student')
                       ->with('student.classe')
                       ->with('student.classe.option')
                       ->get();
               }
           }
       }

        return $paiements;
    }

}
