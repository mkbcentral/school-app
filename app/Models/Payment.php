<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=
        [
            'number_paiement',
            'month_name',
            'scolary_year_id',
            'cost_general_id',
            'inscription_id',
            'user_id',
            'rate_id',
            'school_id'
        ];

    /**
     * Get the Student that owns the Paiement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function rate():BelongsTo{
        return $this->belongsTo(Rate::class,'rate_id');
    }
    /**
     * Get the Const that owns the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
        public function cost(): BelongsTo
    {
        return $this->belongsTo(CostGeneral::class, 'cost_general_id');
    }

    /**
     * Get the inscription that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }


    public function getStudentClasseName(Payment $payment):string{
        return ' '.$payment->inscription->classe->name.'/'.$payment->classe?->classeOption?->name;
    }

}
