<?php

namespace App\Http\Livewire\Helpers\Cost;

use App\Models\TypeOtherCost;
use Illuminate\Support\Collection;

class TypeCostHelper
{
    public function getListTypeCost($defaultScolaryYerId):Collection{
        return TypeOtherCost::where('school_id',auth()->user()->school->id)
            ->where('scolary_year_id',$defaultScolaryYerId)
            ->whereActive(true)
            ->get();
    }

    public function getFirstTypeCostActive($scolaryYearid):TypeOtherCost{
       return TypeOtherCost::where('scolary_year_id',$scolaryYearid)
            ->whereActive(true)
            ->where('school_id',auth()->user()->school->id)->first();
    }
}
