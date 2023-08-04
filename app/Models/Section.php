<?php

namespace App\Models;

use App\Http\Livewire\Helpers\Inscription\GetCounterInscriptionHelper;
use App\Http\Livewire\Helpers\Payment\PaymentCounterHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name','school_id'];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(ClasseOption::class);
    }
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    /**
     * Get student count
     */
    public function getStudentCount($id,$isScolaryYeae):int{
        return (new GetCounterInscriptionHelper())->getCountInscriptionsSection($id,$isScolaryYeae);
    }
    public function getPaymentCount($id,$isScolaryYeae):int{
        return PaymentCounterHelper::getPayementCounterBySection($id,$isScolaryYeae);
    }
}
