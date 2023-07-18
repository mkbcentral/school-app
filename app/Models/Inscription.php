<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = ['cost_inscription_id', 'user_id', 'classe_id', 'scolary_year_id', 'number_paiment', 'student_id','rate_id'];

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


    /**
     * Get the user associated with the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function depense(): HasOne
    {
        return $this->hasOne(DepenseInInscription::class);
    }

    /**
     * Get the user associated with the Inscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function regularisation(): HasOne
    {
        return $this->hasOne(InscRegularisation::class);
    }

    //Get status inscription with payment
    public  function getPaiementStatus(Inscription $inscription):string{
        $status='';
        if ($inscription->is_paied==false){
            $status='INVALIDE';
        }else{
            $status='VALIDE';
        }
        return $status;
    }
    //Get status inscription color with payment
    public  function getPaiementStatusColor(Inscription $inscription):string{
        $status='';
        if ($inscription->is_paied==false){
            $status='danger';
        }else{
            $status='success';
        }
        return $status;
    }

    public function getStudentClasseName(Inscription $inscription):string{
        $name= $inscription?->classe->name.'/'.$inscription?->classe?->classeOption->name;
        return $name;
    }

}
