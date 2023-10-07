<?php

namespace App\Http\Livewire\Application\Rapport\List;

use App\Http\Livewire\Helpers\Cost\CostGeneralHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Notifications\SmsNotificationHelper;
use App\Http\Livewire\Helpers\Payment\GetPaymentByDateHelper;
use App\Http\Livewire\Helpers\Payment\GetPaymentByMonthHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\CostGeneral;
use App\Models\Currency;
use App\Models\Payment;
use Livewire\Component;

class ListRapportPayment extends Component
{
    protected $listeners = [
        'paymentListRefresh' => '$refresh',
        'scolaryYearFresh' => 'getScolaryYear',
        'CurrancyFresh' => 'getCurrency',
        'typeCostSelected' => 'getTypeCost'
    ];
    public $keyToSearch = '', $date_to_search, $defaultCureencyName;
    public $defaultScolaryYerId;
    public $index = 0, $cost_id = 0, $classe_id = 0;
    public $classeList = [];
    public $months = [], $month;
    public $listPayments;
    public $amountPayments;

    /**
     * Reset date to search on null after month property is updated
     * @return void
     */
    public function updatedMonth(): void
    {
        $this->date_to_search = null;
    }

    /**
     * updated cost id property
     * @param $val
     * @return void
     */
    public function updatedCostId($val): void
    {
        $this->cost_id = $val;
    }

    /**
     * Updated classe id property
     * @param $val
     * @return void
     */
    public function updatedClasseId($val): void
    {
        $this->classe_id = $val;
    }

    /**
     * Get selected scolaryYear id with emit ScolaryYearWidget listener
     * @param $id
     * @return void
     */
    public function getScolaryYear($id): void
    {
        $this->defaultScolaryYerId = $id;
    }

    /**
     * Get selected currency with emit CurrencyWidget listener
     * @param $currency
     * @return void
     */
    public  function  getCurrency($currency): void
    {
        $this->defaultCureencyName = $currency;
    }

    /**
     * Update index property for type cost id selected
     * @param $id
     * @return void
     */
    public function getTypeCost($id): void
    {
        $this->index = $id;
    }

    /**
     * Mounted component
     * @param $index
     * @return void
     */
    public function mount($index): void
    {
        $this->index = $index;
        $this->classeList = (new SchoolHelper())->getListClasse();
        $this->months = (new DateFormatHelper())->getMonthsForYear();
        $this->month = date('m');

        $defaultScolaryYer = (new SchoolHelper())->getCurrectScolaryYear();
        $this->defaultScolaryYerId = $defaultScolaryYer->id;

        $defaultCurrency = (new SchoolHelper())->getCurrentCurrency();
        $this->defaultCureencyName = $defaultCurrency->currency;
    }

    public function delete(string $id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        $this->dispatchBrowserEvent('updated', ['message' => "Payment bien rétiré !"]);
    }

    public function edit(Payment $payment): void
    {
        $this->emit('paymentToEdit', $payment);
    }
    public function sendPaymentSMS($id)
    {
        $payment = Payment::find($id);
        if ($payment->student->studentResponsable) {
            SmsNotificationHelper::sendSMS(
                '+243898337969',
                '+243' . $payment->student->studentResponsable->phone,
                    "C.S.".auth()->user()->school->name . "\nBonjour Votre enfant "
                    . $payment->student->name
                    . " est en ordre avec le frais "
                    . $payment->cost->name . "\nCout:" . $payment->cost->amount . " " .
                    $payment->cost->currency->currency .
                    "\nDépuis le:" . $payment->created_at->format('d/m/Y')
            );
            $payment->has_sms=true;
            $payment->update();
            $this->dispatchBrowserEvent('added', ['message' => 'Message bien envoyé']);
        } else {
            $this->dispatchBrowserEvent('error', ["message'=>'Echec d'envoi"]);
        }
    }

    /**
     * Loading initial data
     * @return void
     */
    public function loadData(): void
    {

        if ($this->date_to_search == null) {
            $this->listPayments = GetPaymentByMonthHelper::getMonthPayments(
                $this->month,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->index,
                $this->classe_id,
                $this->keyToSearch,
                $this->defaultCureencyName
            );
            $this->amountPayments = GetPaymentByMonthHelper::getAmoutMonthPayments(
                $this->month,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->index,
                $this->classe_id,
                $this->keyToSearch,
                $this->defaultCureencyName
            );
        } else {
            $this->listPayments = GetPaymentByDateHelper::getDatePayments(
                $this->date_to_search,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->index,
                $this->classe_id,
                $this->keyToSearch,
                $this->defaultCureencyName
            );
            $this->amountPayments = GetPaymentByMonthHelper::getAmoutDatePayments(
                $this->date_to_search,
                $this->defaultScolaryYerId,
                $this->cost_id,
                $this->index,
                $this->classe_id,
                $this->keyToSearch,
                $this->defaultCureencyName
            );
        }
    }

    public function render()
    {
        $listCost = (new CostGeneralHelper())->getListCostGeneral($this->index, $this->defaultScolaryYerId);
        $this->loadData();
        return view(
            'livewire.application.rapport.list.list-rapport-payment',
            [
                'listCost' => $listCost, 'listPayments' => $this->listPayments,
                'amountPayments' => $this->amountPayments
            ]
        );
    }
}
