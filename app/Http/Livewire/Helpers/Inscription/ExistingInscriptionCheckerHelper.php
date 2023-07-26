<?php

namespace App\Http\Livewire\Helpers\Inscription;

use App\Models\Inscription;

class ExistingInscriptionCheckerHelper
{
    public static function checkIfInscriptionExist($studentId,$classeId,$scolaryYearId): ?Inscription
    {
          return Inscription::where('student_id', $studentId)
            ->where('classe_id', $classeId)
            ->where('scolary_year_id', $scolaryYearId)
            ->first();
    }
}
