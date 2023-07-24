<?php
use App\Http\Controllers\Application\Pages\ApplicationLinkController;
use App\Http\Livewire\Application\Dashboard\MainDashboard;
use App\Http\Livewire\Application\Inscription\NewInscription;
use App\Http\Livewire\Application\Inscription\NewReinscription;
use App\Http\Livewire\Application\Payment\ValideInscriptionPayment;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Application\Payment\OtherCostPayment;
use App\Http\Livewire\Application\Settings\AppLinkSettings;
use App\Http\Livewire\Application\Settings\AppSettings;
use App\Http\Livewire\Application\Rapport\PaymentRapport;
use App\Http\Controllers\Application\Printings\RapportPaymentPrintingController;
use App\Http\Livewire\Application\Rapport\Inscription\RapportInscriptionByClasse;
use App\Http\Controllers\Application\Pages\CreateSchoolController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Route::middleware('auth')->group(function () {
    Route::get('/', ApplicationLinkController::class)->name('main')->middleware('school-checker');
    Route::get('/app-create-school', CreateSchoolController::class)->name('school.create');
    //DASHBOARD REFACTORING
    Route::prefix('dashboard')->group(function () {
        Route::get('main',MainDashboard::class)->name('dashboard.main');
    });
    //INSCRIPTION REFACTORING
    Route::prefix('inscription')->group(function () {
        Route::get('new-inscription',NewInscription::class)->name('inscription.new');
        Route::get('new-reinscription',NewReinscription::class)->name('reinscription.new');
        Route::get('valide-payment',ValideInscriptionPayment::class)->name('inscription.payment.valide');
    });
    //Payment routes
    Route::prefix('payment')->group(function () {
        Route::get('other-cost-payment',OtherCostPayment::class)->name('payment.other.cost');
    });
    //Settings links route
    Route::prefix('settings')->group(function () {
        Route::get('app-link-settings',AppLinkSettings::class)->name('settings.app.links');
        Route::get('app-settings',AppSettings::class)->name('settings.app');
    });
    //Rapport payment
    Route::prefix('rapport')->group(function () {
        Route::get('payments',PaymentRapport::class)->name('rapport.payments');
        Route::get('inscription-by-classe',RapportInscriptionByClasse::class)->name('rapport.inscription.by.classe');
    });


    //Pint rapport payment cost
    Route::prefix('printing')->group(function () {
        Route::get('print-payments-rapport/{month}/{idSColaryYear}/{isCost}/{type}/{classeId}/{currency}',
            [RapportPaymentPrintingController::class,'printRapport'])->name('print.rapport.payments');
    });
});
