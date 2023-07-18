<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeOtherCost extends Model
{
    use HasFactory;
    protected $fillable=['name','school_id','active'];
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

    public  function getPayment($idType,$studentId,$month):string{
        $scolaryYear=ScolaryYear::where('name','2022-2023')->first();
        $status='';
        $payment=Paiment::join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('paiments.student_id',$studentId)
            ->where('paiments.school_id',auth()->user()->school->id)
            ->where('paiments.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('paiments.mounth_name',$month)
            ->select('paiments.*')
            ->first();
        if($payment){
            $status='OK';
        }else{
            $status='-';
        }
        return  $status;
    }

    public function getBgColor($month):string{
        $bg='';
        if ($month=='06' || $month=='07' || $month=='08'){
            $bg='bg-danger';
        }
        return $bg;
    }
}
