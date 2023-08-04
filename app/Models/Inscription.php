<?php

namespace App\Models;

use App\Http\Livewire\Helpers\Payment\GetPaymentByTypeCostToCheck;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inscription extends Model
{
    use HasFactory;
    protected $fillable = ['cost_inscription_id', 'user_id', 'classe_id', 'scolary_year_id', 'school_id', 'number_paiment', 'student_id', 'rate_id', 'is_old_student'];

    /**
     * Get the Student that owns the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Get the Student that owns the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cost(): BelongsTo
    {
        return $this->belongsTo(CostInscription::class, 'cost_inscription_id');
    }

    /**
     * Get the classe that owns the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    /**
     * Get the school that owns the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function scolaryyear(): BelongsTo
    {
        return $this->belongsTo(ScolaryYear::class, 'scolary_year_id');
    }

    /**
     * Get the user associated with the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class, 'rate_id');
    }
    /**
     * Get all of the payments for the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    //Get status inscription with payment
    public  function getPaiementStatus(Inscription $inscription): string
    {
        $status = '';
        if (!$inscription->is_paied) {
            $status = 'En cours';
        } else {
            $status = 'VALIDE';
        }
        return $status;
    }
    //Get status inscription color with payment
    public  function getPaiementStatusColor(Inscription $inscription): string
    {
        $status = '';
        if (!$inscription->is_paied) {
            $status = 'danger';
        } else {
            $status = 'success';
        }
        return $status;
    }

    public function getStudentClasseName(Inscription $inscription): string
    {
        return ' ' . $inscription?->classe->name . '/' . $inscription?->classe?->classeOption->name;
    }

    public  function getByCurrentYearPaymentCheckerStatus($idType, $studentId, $month): string
    {
        $payment = GetPaymentByTypeCostToCheck::getCurrentYearPaymentChecker($idType, $studentId, $month);
        $status = '';
        if ($payment) {
            return   $status = 'OK';
        } else {
            return  $status = '-';
        }
    }

    public  function getByCurrentYearBycostPaymentCheckerStatus($idType, $studentId, $month, $costId): string
    {
        $payment = GetPaymentByTypeCostToCheck::getCurrentYearCostPaymentChecker($idType, $studentId, $month, $costId);
        $status = '';
        if ($payment) {
            return   $status = 'OK';
        } else {
            return  $status = '-';
        }
    }
}
