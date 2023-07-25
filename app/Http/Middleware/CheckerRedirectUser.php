<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckerRedirectUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ucrrentRouteName=Route::currentRouteName();
        if (in_array($ucrrentRouteName,$this->userAccessRole()[ auth()->user()->getRoleNames()[0]])) {
            return $next($request);
        } else {
            abort(403);
        }
    }

    Public function userAccessRole(){
        return [
            'Super-Admin'=>[
                'main',
                'filament.pages.dashboard',
                'school.create',
                'dashboard.main',
                'settings.app.links',
                'settings.app',
            ],
            'Cordonateur'=>[
                'main',
                'dashboard.main',
                'rapport.payments',
                'rapport.inscription.by.classe'
            ],
            'Financier'=>[
                'main',
                'dashboard.main',
                'inscription.payment.valide',
                'payment.other.cost',
                'rapport.payments',
                'rapport.inscription.by.classe'
            ],
            'Secretaire'=>[
                'main',
                'dashboard.main',
                'inscription.new',
                'reinscription.new'
            ],
            'Prefet'=>[
                'main',
                'dashboard.main',
            ],
            'Directeur'=>[
                'main',
                'dashboard.main',
            ]
        ];
    }
}
