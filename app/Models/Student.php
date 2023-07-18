<?php

namespace App\Models;

use App\Http\Livewire\Helpers\DateFormatHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date_of_birth', 'place_of_birth','scolary_year_id', 'gender', 'classe_id', 'cost_inscription_id'];

    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];
    public function getAge($date)
    {
        return (new DateFormatHelper())->getUserAge($date);
    }

    /**
     * Get the Inscription associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inscription(): HasOne
    {
        return $this->hasOne(Inscription::class);
    }

    /**
     * Get the Paiement associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paiement(): HasOne
    {
        return $this->hasOne(Paiment::class);
    }

    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(StudentResponsable::class, 'student_responsable_id');
    }

    /**
     * Get the ScolaryYear that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scolaryYear(): BelongsTo
    {
        return $this->belongsTo(ScolaryYear::class, 'scolary_year_id');
    }

    public function getPaiementStatus($mounth, $id, $cost)
    {
        $paimement = Paiment::where('student_id', $id)
            ->where('mounth_name', $mounth)
            ->where('cost_general_id', $cost)
            ->first();
        return $paimement;
    }

    public function getPaimentByMont($student_id, $mounth, $cost_id)
    {
        $paimement = Paiment::join('cost_generals', 'paiments.cost_general_id', '=', 'cost_generals.id')
            ->join('type_other_costs', 'cost_generals.type_other_cost_id', '=', 'type_other_costs.id')
            ->where('paiments.student_id', $student_id)
            ->where('paiments.mounth_name', $mounth)
            ->where('cost_generals.type_other_cost_id', $cost_id)
            ->first();
        if ($paimement) {
            return 'Ok';
        } else {
            return '-';
        }
    }
}
