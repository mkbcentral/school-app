<?php

namespace App\Http\Livewire\Helpers\Responsable;

use App\Models\StudentResponsable;

class CreateNewResponsableHelper
{
    public static function create(array $data): StudentResponsable{
       $responsable= StudentResponsable::create($data);
       return $responsable;
    }
}
