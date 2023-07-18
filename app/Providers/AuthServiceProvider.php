<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Classe;
use App\Models\ClasseOption;
use App\Models\CostGeneral;
use App\Models\CostInscription;
use App\Models\Currency;
use App\Models\Gender;
use App\Models\Rate;
use App\Models\Role;
use App\Models\School;
use App\Models\ScolaryYear;
use App\Models\Section;
use App\Models\TypeOtherCost;
use App\Models\User;
use App\Policies\ClasseOptionPolicy;
use App\Policies\ClassePolicy;
use App\Policies\CostGeneralPolicy;
use App\Policies\CurrencyPolicy;
use App\Policies\GenderPolicy;
use App\Policies\RatePolicy;
use App\Policies\RolePolicy;
use App\Policies\SchoolPolicy;
use App\Policies\ScolaryYearPolicy;
use App\Policies\SectionPolicy;
use App\Policies\TypeOtherCostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class=>UserPolicy::class,
        Role::class=>RolePolicy::class,
        Rate::class=>RatePolicy::class,
        Currency::class=>CurrencyPolicy::class,
        TypeOtherCost::class=>TypeOtherCostPolicy::class,
        CostGeneral::class=>CostGeneralPolicy::class,
        CostInscription::class=>CostGeneralPolicy::class,
        Classe::class=>ClassePolicy::class,
        School::class=>SchoolPolicy::class,
        ScolaryYear::class=>ScolaryYearPolicy::class,
        Gender::class=>GenderPolicy::class,
        ClasseOption::class=>ClasseOptionPolicy::class,
        Section::class=>SectionPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
