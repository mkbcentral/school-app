<?php

namespace App\Http\Livewire\Helpers;

use App\Models\Classe;
use App\Models\ClasseOption;
use App\Models\Currency;
use App\Models\Gender;
use App\Models\Rate;
use App\Models\ScolaryYear;
use Illuminate\Support\Collection;

class SchoolHelper
{
    //Get current rate
    public  function  getCurrentRate():Rate{
        $rate=Rate::where('school_id',auth()->user()->school->id)
            ->where('status',true)
            ->first();
        return  $rate;
    }
    //Get current scolary year
    public  function  getCurrectScolaryYear():ScolaryYear{
        $scolaryYear= ScolaryYear::where('active', true)
            ->where('school_id',auth()->user()->school->id)
            ->first();
        return $scolaryYear;
    }

    public function getCurrentCurrency():Currency{
        $currency= Currency::where('id', 1)
            ->where('school_id',auth()->user()->school->id)
            ->first();
        return $currency;
    }

    //get list of classes by option
    public function getListClasseByOption( $id):Collection{

        $classeList = Classe::join('classe_options', 'classe_options.id', '=', 'classes.classe_option_id')
            ->join('sections', 'sections.id', '=', 'classe_options.section_id')
            ->join('schools', 'schools.id', '=', 'sections.school_id')
            ->where('sections.school_id', auth()->user()->school->id)
            ->where('classes.classe_option_id', $id)
            ->select('classes.*')
            ->get();
        return $classeList;
    }
    //get list of classes
    public function getListClasse():Collection{

        $classeList = Classe::join('classe_options', 'classe_options.id', '=', 'classes.classe_option_id')
            ->join('sections', 'sections.id', '=', 'classe_options.section_id')
            ->join('schools', 'schools.id', '=', 'sections.school_id')
            ->where('sections.school_id', auth()->user()->school->id)
            ->select('classes.*')
            ->orderBy('name','asc')
            ->get();
        return $classeList;
    }
    //get list of classes option
    public function  getListClasseOption():Collection{
        $listClasseOption=ClasseOption::join('sections','sections.id','=','classe_options.section_id')
            ->where('sections.school_id',auth()->user()->school->id)
            ->select('classe_options.*')
            ->get();
        return $listClasseOption;
    }
    //Get list classe option by section_id
    public function  getListClasseOptionBySectionId($id):Collection{
        $listClasseOption=ClasseOption::join('sections','sections.id','=','classe_options.section_id')
            ->where('sections.school_id',auth()->user()->school->id)
            ->where('classe_options.section_id',$id)
            ->select('classe_options.*')
            ->get();
        return $listClasseOption;
    }
    //Get list of gender
    public function getListOfGender():Collection{
        $genderList = Gender::all();
        return $genderList;
    }
}
