<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResponsable extends Model
{
    use HasFactory;
    protected $fillable=['name_responsable','phone','other_phone','email'];
}
