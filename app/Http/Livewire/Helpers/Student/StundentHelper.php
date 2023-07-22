<?php

namespace App\Http\Livewire\Helpers\Student;

use App\Models\Student;

class StundentHelper
{
    public  static function create(array $data):Student{
       return Student::create($data);
    }
}
