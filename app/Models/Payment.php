<?php

namespace App\Models;

use App\Http\Livewire\Helpers\SchoolHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    /**
     * @var mixed|true
     */
    protected $fillable=
        [
            'number_payment',
            'month_name',
            'cost_general_id',
            'inscription_id',
            'scolary_year_id',
            'student_id',
            'classe_id',
            'user_id',
            'rate_id',
            'school_id',
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
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
    public function getStudentClasseName(Payment $payment):string{
        return ' '.$payment->classe->name.'/'.$payment->classe?->classeOption?->name;
    }

    public function getStudentClasseNameForCurrentYear(string $idStudent): string
    {
        $scoalyYear=(new SchoolHelper())->getCurrectScolaryYear();
        $payment=Payment::where('student_id', $idStudent)
            ->where('scolary_year_id', $scoalyYear->id)
            ->first();
        return ' ' . $payment?->classe->name . '/' . $payment?->classe?->classeOption->name;
    }

    public function getCurrencyByTypeCostName($name){
        $type=TypeOtherCost::where('name',$name)->first();
        return $type?->cureency?->currency;
    }

}
