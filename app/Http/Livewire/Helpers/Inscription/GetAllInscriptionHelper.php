<?php

namespace  App\Http\Livewire\Helpers\Inscription;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Inscription;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GetAllInscriptionHelper
{
    public static function getAllInscription($scolaryYearId, $classeId, string $keyTosearch): LengthAwarePaginator
    {
        if ($classeId == 0) {
            return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
                ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
                ->join('rates', 'rates.id', '=', 'inscriptions.rate_id')
                ->where('inscriptions.scolary_year_id', $scolaryYearId)
                ->where('students.name', 'LIKE', '%' . $keyTosearch . '%')
                ->orderBy('inscriptions.created_at', 'DESC')
                ->with('Cost')
                ->with('student')
                ->with('school')
                ->with('classe.classeOption')
                ->select('inscriptions.*')
                ->paginate(25);
        } else {
            return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
                ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
                ->join('rates', 'rates.id', '=', 'inscriptions.rate_id')
                ->where('inscriptions.scolary_year_id', $scolaryYearId)
                ->where('inscriptions.classe_id', $classeId)
                ->where('students.name', 'LIKE', '%' . $keyTosearch . '%')
                ->orderBy('inscriptions.created_at', 'DESC')
                ->with('Cost')
                ->with('student')
                ->with('school')
                ->with('classe.classeOption')
                ->select('inscriptions.*')
                ->paginate(25);
        }
    }

    public static function getListInscriptionByClasseForCurrentYear($classeId, string $keyTosearch): Collection
    {
        $currentScolaryYear = (new SchoolHelper())->getCurrectScolaryYear();
        return Inscription::join('students', 'inscriptions.student_id', '=', 'students.id')
            ->join('cost_inscriptions', 'cost_inscriptions.id', '=', 'inscriptions.cost_inscription_id')
            ->where('inscriptions.scolary_year_id', $currentScolaryYear->id)
            ->where('students.name', 'LIKE', '%' . $keyTosearch . '%')
            ->where('inscriptions.classe_id', $classeId)
            ->orderBy('students.name', 'ASC')
            ->with('Cost')
            ->with('student')
            ->with('school')
            ->with('classe.classeOption')
            ->select('inscriptions.*')
            ->get();
    }
}
