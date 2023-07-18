<?php

namespace App\Http\Livewire\Helpers\Inscription;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;

class CreateInscriptionHelper
{
    public  function create($scolaryYear_id,$cost_inscription_id,$student_id,$classe_id):Inscription{
        $rate=(new SchoolHelper())->getCurrentRate();
        $inscription= Inscription::create([
            'scolary_year_id' => $scolaryYear_id,
            'cost_inscription_id' => $cost_inscription_id,
            'student_id' => $student_id,
            'classe_id' => $classe_id,
            'school_id' => auth()->user()->school->id,
            'user_id' => auth()->user()->id,
            'rate_id' => $rate->id
        ]);
        return $inscription;
    }
}
