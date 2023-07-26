<?php

namespace App\Models;

use App\Http\Livewire\Helpers\Payment\GetPaymentByTypeCostToCheck;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeOtherCost extends Model
{
    use HasFactory;
    protected $fillable=['name','school_id','active','scolary_year_id'];
    /**
     * Get all of the comments for the TypeOtherCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function costs(): HasMany
    {
        return $this->hasMany(CostGeneral::class);
    }
    /**
     * Get the school that owns the TypeOtherCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    /**
     * Get the scolaryYear that owns the CostInscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scolaryYear(): BelongsTo
    {
        return $this->belongsTo(ScolaryYear::class, 'scolary_year_id');
    }

    public  function getPaymentCheckerStatus($idType,$studentId,$month):string{
        $payment=GetPaymentByTypeCostToCheck::getPaymentChecker($idType,$studentId,$month);
        $status='';
        if($payment){
            return   $status='OK';
        }else{
            return  $status='-';
        }
    }

    public  function getPaymentCheckerBgtatus($idType,$studentId,$month):string{
        $payment=GetPaymentByTypeCostToCheck::getPaymentChecker($idType,$studentId,$month);
        $status='';
        if($payment){
            return $status;
        }else{
            return $status='bg-danger';
        }
    }

    public function getBgColorWithMonthNotPayment($month):string{
        $bg='';
        if ($month=='06' || $month=='07' || $month=='08'){
            $bg='bg-success';
        }
        return $bg;
    }
}
