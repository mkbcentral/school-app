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
        $cucrrentRouteName=Route::currentRouteName();
        if (in_array($cucrrentRouteName,$this->userAccessRole()[ auth()->user()->getRoleNames()[0]])) {
            return $next($request);
        } else {
            abort(403);
        }
    }


    Public function userAccessRole(){
        return [
            'App-Admin'=>[
                'filament.pages.dashboard',
                'main',
            ],
            'Super-Admin'=>[
                'main',
                'filament.pages.dashboard',
                'school.create',
                'dashboard.main',
                'settings.app.links',
                'settings.app',
            ],
            'Coordinator'=>[
                'main',
                'dashboard.main',
                'rapport.payments',
                'rapport.inscription.by.classe',
                'inscription.payment.valide',
                'payment.other.cost',
                ' filament.pages.dashboard',
                'payment.control',
            ],
            'Finance'=>[
                'main',
                'dashboard.main',
                'inscription.payment.valide',
                'payment.other.cost',
                'rapport.payments',
                'rapport.inscription.by.classe',
                'print.rapport.payments',
                'payment.control',
                'rapport.receipt.all.by.section',
                'receipt.inscription',
                'receipt.payment',
                'print.rapport.inscription.payment.by.day',
                'depense.all',
                'payment.late',
                'tarification.cost.general'
            ],
            'Secretary'=>[
                'main',
                'dashboard.main',
                'inscription.new',
                'reinscription.new'
            ],
        ];
    }
}
