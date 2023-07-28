<?php

namespace App\Http\Livewire\Helpers\Inscription;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use Illuminate\Support\Collection;

class GetListInscriptionByClasseHelper
{
    public static function  getListInscrptinForCurrentYear(int $classeId):Collection{
        $scolaryYearId=(new SchoolHelper())->getCurrectScolaryYear();
        return Inscription::join('classes','classes.id','=','inscriptions.classe_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId->id)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.is_paied',true)
            ->where('inscriptions.is_old_student',false)
            ->where('inscriptions.classe_id',$classeId)
            ->orderBy('inscriptions.created_at','DESC')
            ->with('Cost')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->get();
    }
}
