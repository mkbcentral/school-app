<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Models\Paiment;
class CreatePaymentCheckerHelper
{
    public static function checkIfPaymentExistBeforCreate($student_id,$month,$type_other_cost,$defaultScolaryYerId):bool{
        $status=false;
        $payment= Paiment::where('student_id',$student_id)
            ->where('mounth_name',$month)
            ->where('cost_general_id',$type_other_cost)
            ->where('scolary_year_id',$defaultScolaryYerId)
            ->first();
       if ($payment){
           $status=true;
       }else{
           $status=false;
       }
       return $status;
    }
}
